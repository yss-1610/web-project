<script>
    import { goto } from '$app/navigation';

    let username = $state('');
    let password = $state('');
    let errorMessage = $state('');

    async function handleSubmit(event) {
        event.preventDefault();
        if (username.trim() === "" || password.trim() === "") {
            errorMessage = "Lütfen tüm alanları doldurunuz.";
            return;
        }

        const emailRegex = /^[bBgGcCAa]\d{10}@sakarya\.edu\.tr$/;
        if (!emailRegex.test(username)) {
            errorMessage = "Lütfen geçerli bir öğrenci maili giriniz (Örn: b2412100001@sakarya.edu.tr)";
            return;
        }
        errorMessage = "";

        const formData = new FormData();
        formData.append('action', 'login');
        formData.append('email', username);
        formData.append('password', password);

        try {
            const response = await fetch('http://localhost/api/server.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            if (!response.ok) {
                throw new Error('HTTP error! ' + result.status);
            }
            if (result.success === "true") {
                goto(`/login/basari?ogrNo=${password.trim()}`);
            } else {
                errorMessage = "Şifre veya Kullanıcı Adı Hatalı";
            }
        } catch (error) {
            errorMessage = error.message;
        }
    }
</script>

<div class="form-container">
    <div class="form-card">
        <h1 class="form-title">Giriş Yap</h1>

        {#if errorMessage}
            <div class="form-error">
                {errorMessage}
            </div>
        {/if}

        <form onsubmit={handleSubmit}>
            <div class="form-group">
                <label for="username">E-posta</label>
                <input
                    type="text"
                    id="username"
                    class="form-input"
                    bind:value={username}
                    placeholder="b2412100001@sakarya.edu.tr"
                >
            </div>

            <div class="form-group">
                <label for="password">Şifre</label>
                <input
                    type="password"
                    id="password"
                    class="form-input"
                    bind:value={password}
                    placeholder="Şifreniz"
                >
            </div>

            <button type="submit" class="form-btn">Giriş Yap</button>
        </form>
    </div>
</div>
