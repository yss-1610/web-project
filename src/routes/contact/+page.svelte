<script>
    import { z } from 'zod';

    let name = $state('');
    let phone = $state('');
    let email = $state('');
    let message = $state('');
    let age = $state(0);
    let selectedSuggestions = $state([]);
    let errors = $state({});
    let errorMessage = $state('');
    let submittedData = $state(null);

    const suggestions = ["Vlog", "Hata düzeltme", "Tasarım", "Blog", "Harici"];
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const phoneRegex = /^5[0-9]{9}$/;
    const nameRegex = /^[a-zA-ZğüşıöçĞÜŞİÖÇ ]{2,30}$/;

    function resetForm() {
        name = '';
        email = '';
        phone = '';
        age = 0;
        message = '';
        selectedSuggestions = [];
        errors = {};
    }

    async function NTSubmit() {
        let isValid = true;
        errors = {};
        if (name.trim() === "" || !nameRegex.test(name)) {
            errors.name = "Lütfen Geçerli Bir İsim Girin";
            isValid = false;
        }
        if (email.trim() === "" || !emailRegex.test(email)) {
            errors.email = "Lütfen Geçerli Bir E-Posta Adresi Girin";
            isValid = false;
        }
        if (phone.trim() === "" || !phoneRegex.test(phone)) {
            errors.phone = "Lütfen Geçerli Bir Telefon Numarası Girin";
            isValid = false;
        }
        if (selectedSuggestions.length === 0) {
            errors.suggestions = "En Az Bir Başlık Seçilmelidir";
            isValid = false;
        }
        if (age === 0) {
            errors.age = "Lütfen Geçerli Bir Yaş Girin";
            isValid = false;
        }
        if (message.trim() === '') {
            errors.message = "Mesaj Alanı Boş Bırakılamaz";
            isValid = false;
        }
        if (isValid) {
            let formData = new FormData();
            formData.append('action', 'contact');
            formData.append('name', name);
            formData.append('email', email);
            formData.append('phone', phone);
            formData.append('age', age);
            selectedSuggestions.forEach(s => formData.append('suggestions[]', s));
            try {
                const response = await fetch('http://localhost/api/server.php', {
                    method: 'POST',
                    body: formData
                });
                if (!response.ok) {
                    throw new Error('HTTP error! ' + response.status);
                }
                const responseData = await response.json();
                submittedData = {
                    name,
                    email,
                    phone,
                    age,
                    suggestions: [...selectedSuggestions],
                    message,
                    serverResponse: responseData
                };
                resetForm();
            } catch (error) {
                errorMessage = error.message;
            }
        }
    }

    const schema = z.object({
        action: z.string(),
        name: z.string().regex(nameRegex, "Lütfen geçerli bir isim girin"),
        email: z.string().email("Lütfen geçerli bir e-posta adresi girin"),
        phone: z.string().regex(phoneRegex, "Lütfen Geçerli Bir Telefon Numarası Girin"),
        age: z.coerce.number().int().min(1, "Lütfen Geçerli Bir Yaş Girin"),
        suggestions: z.array(z.string()).min(1, "En Az Bir Başlık Seçilmelidir"),
        message: z.string().trim().min(1, "Mesaj Alanı Boş Bırakılamaz").min(10, "Mesaj en az 10 karakterli olmalı")
    });

    async function ZodSubmit() {
        errors = {};
        const isValid = schema.safeParse({
            action: 'contact', name, email, phone, age, suggestions: selectedSuggestions, message
        });
        if (!isValid.success) {
            isValid.error.issues.forEach((e) => {
                const fieldName = e.path[0];
                errors[fieldName] = e.message;
            });
            return;
        }
        let formData = new FormData();
        formData.append('action', 'contact');
        formData.append('name', name);
        formData.append('email', email);
        formData.append('phone', phone);
        formData.append('age', age);
        selectedSuggestions.forEach(s => formData.append('suggestions[]', s));
        formData.append('message', message);
        try {
            const response = await fetch('http://localhost/api/server.php', {
                method: 'POST',
                body: formData
            });
            if (!response.ok) {
                throw new Error('HTTP error! ' + response.status);
            }
            const responseData = await response.json();
            submittedData = {
                name,
                email,
                phone,
                age,
                suggestions: [...selectedSuggestions],
                message,
                serverResponse: responseData
            };
            resetForm();
        } catch (err) {
            errorMessage = err.message;
        }
    }
</script>

<div class="form-container">
    <div class="form-card form-card-wide">
        <h1 class="form-title">İletişim</h1>

        {#if errorMessage}
            <div class="form-error">
                {errorMessage}
            </div>
        {/if}

        {#if submittedData}
            <div class="submitted-data">
                <h3>Gönderilen Bilgiler</h3>
                <div class="submitted-row">
                    <span class="submitted-label">Ad Soyad:</span>
                    <span class="submitted-value">{submittedData.name}</span>
                </div>
                <div class="submitted-row">
                    <span class="submitted-label">E-Posta:</span>
                    <span class="submitted-value">{submittedData.email}</span>
                </div>
                <div class="submitted-row">
                    <span class="submitted-label">Telefon:</span>
                    <span class="submitted-value">{submittedData.phone}</span>
                </div>
                <div class="submitted-row">
                    <span class="submitted-label">Yaş:</span>
                    <span class="submitted-value">{submittedData.age}</span>
                </div>
                <div class="submitted-row">
                    <span class="submitted-label">Başlıklar:</span>
                    <span class="submitted-value">{submittedData.suggestions.join(', ')}</span>
                </div>
                <div class="submitted-row">
                    <span class="submitted-label">Mesaj:</span>
                    <span class="submitted-value">{submittedData.message}</span>
                </div>
                <button class="form-btn" onclick={() => submittedData = null}>Kapat</button>
            </div>
        {/if}

        <form>
            <div class="form-group">
                <label for="name">Ad Soyad</label>
                <input type="text" id="name" class="form-input" bind:value={name} placeholder="Adınız Soyadınız">
                {#if errors.name}<div class="field-error">{errors.name}</div>{/if}
            </div>

            <div class="form-group">
                <label for="age">Yaş</label>
                <div class="range-group">
                    <input type="range" id="age" max="90" min="0" bind:value={age}>
                    <input type="number" id="age-num" bind:value={age} min="0" max="90">
                </div>
                {#if errors.age}<div class="field-error">{errors.age}</div>{/if}
            </div>

            <div class="form-group">
                <label for="eposta">E-Posta</label>
                <input type="email" id="eposta" class="form-input" bind:value={email} placeholder="ornek@email.com">
                {#if errors.email}<div class="field-error">{errors.email}</div>{/if}
            </div>

            <div class="form-group">
                <label for="phone">Telefon</label>
                <input type="text" id="phone" class="form-input" bind:value={phone} placeholder="5XXXXXXXXX">
                {#if errors.phone}<div class="field-error">{errors.phone}</div>{/if}
            </div>

            <div class="form-group">
                {#if errors.suggestions}<div class="field-error">{errors.suggestions}</div>{/if}
                <label>Öneri Başlıkları</label>
                <div class="checkbox-group">
                    {#each suggestions as sugg, i}
                        <div class="checkbox-item">
                            <input type="checkbox" id="sugg{i}" value={sugg} bind:group={selectedSuggestions}>
                            <label for="sugg{i}">{sugg}</label>
                        </div>
                    {/each}
                </div>
            </div>

            <div class="form-group">
                <label for="message">Eklemek İstedikleriniz</label>
                <textarea id="message" class="form-input form-textarea" bind:value={message} placeholder="Mesajınız ..."></textarea>
                {#if errors.message}<div class="field-error">{errors.message}</div>{/if}
            </div>

            <div class="form-actions">
                <button type="button" class="form-btn" onclick={NTSubmit}>Gönder</button>
                <button type="button" class="form-btn form-btn-secondary" onclick={ZodSubmit}>Z Gönder</button>
            </div>
        </form>
    </div>
</div>
