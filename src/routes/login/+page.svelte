<script>
    import { goto } from '$app/navigation';

    let username =$state('');
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
            const response = await fetch('/login.php', {
                method: 'POST',
                body: formData
            });

            const result = await response;
            if (!result.ok) {
                throw new Error('HTTP error! '+result.status);
                
            }
            if (result==="true") {
                goto(`/login/basari?ogrNo=${password.trim()}`);
            } else {
                goto("/login");
                throw new Error("Hatalı giriş");
            }
        } catch (error) {
            errorMessage = {error};
        }
    }
</script>

{#if errorMessage}
    <div style="color: red; margin-bottom: 10px; padding: 10px; background-color: #ffe6e6; border-radius: 5px;">
        {errorMessage}
    </div>
{/if}

<form onsubmit={handleSubmit}>
    <label for="username">E-posta :</label><br>
    <input type="text" id="username" bind:value={username} placeholder="b2412100001@sakarya.edu.tr"><br><br>

    <label for="password">Şifre :</label><br>
    <input type="password" id="password" bind:value={password} placeholder="b2412100001"><br><br>

    <button type="submit" >Giriş Yap</button>
</form>