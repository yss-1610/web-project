<script>
    import { error } from "@sveltejs/kit";
    import { preventDefault } from "svelte/legacy";
    import { z } from 'zod';

let name =$state('');  
let phone =$state('');
let email = $state('');
let message = $state('');
let age = $state(0);
let selectedSuggestions = $state([]);
let errors =$state({})

const suggestions = ["Vlog ","Hata düzeltme","Tasarım","Blog","Harici"];
const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const phoneRegex = /^5[0-9]{9}$/;
const nameRegex = /^[a-zA-ZğüşıöçĞÜŞİÖÇ ]{2,30}$/;
async function NTSubmit() {
    let isValid =true;
    errors = {};
    if (name.trim()===""|| !nameRegex.test(name)) {
        errors.name="Lütfen Geçerli Bir İsim Girin";
        isValid=false;
    }if (email.trim()===""||!emailRegex.test(email)){
        errors.email="Lütfen En Az Bir Yöntemi Seçiniz";
        isValid=false;
    }if (phone.trim()===""||!phoneRegex.test(phone)) {
        errors.phone="Lütfen Geçerli Bir Telefon Numarası Girin";
        isValid=false;
    }if (selectedSuggestions.length==0) {
        errors.sugg="En Az Bir Başlık Seçilmelidir";
        isValid=false;
    }if (age===0) {
        errors.age="Lütfen Geçerli Bir Yaş Girin ";
        isValid=false;
    }if (message.trim()==='') {
        errors.message="Mesaj Alanı Boş Nırakılamaz";
        isValid=false;
    }if (isValid) {
        let formData =new FormData()
        formData.append('action','contact');
        formData.append('name',name);
        formData.append('email',email);
        formData.append('phone',phone);
        formData.append('age',age);
        formData.append('suggestions',selectedSuggestions);
        formData.append('message',message);
        try {
            const response = await fetch('/login.php', {
                method: 'POST',
                body: formData
            });

            const result = await response;
            if (!result.ok) {
                throw new Error('HTTP error! '+result.status);
                
            }
        } catch (error) {
            errorMessage = {error};
        }
    }
}
const schema = z.object({
    action: z.string(),
    name: z.string().regex(nameRegex),
    email: z.string().email(emailRegex),
    phone: z.string().regex(phoneRegex,"Lütfen Geçerli Bir Telefon Numarası Girin"),
    age: z.number().int().min(1,"Lütfen Geçerli Bir Yaş Girin "),
    suggestions: z.array().string().min(1,"En Az Bir Başlık Seçilmelidir"),
    message: z.string().trim("Mesaj Alanı Boş Nırakılamaz")
});
async function ZodSubmit(params) {
    errors = {};
    let formData =new FormData()
        formData.append('action','contact');
        formData.append('name',name);
        formData.append('email',email);
        formData.append('phone',phone);
        formData.append('age',age);
        formData.append('suggestions',selectedSuggestions);
        formData.append('message',message);
    try {
        formSchema.parse(formData);
        alert('Zod Kütüphanesi Doğrulaması Başarılı! Veriler sunucuya gönderiliyor...');
        const response = await fetch('/login.php', {
                method: 'POST',
                body: formData
            });

            const result = await response;
            if (!result.ok) {
                throw new Error('HTTP error! '+result.status);
                
            }
        } catch (err) {
            if (err instanceof z.ZodError) {
                err.errors.forEach((e) => {
                    const fieldName = e.path[0];
                    errors[fieldName] = e.message;
                });
            }
        }
}

</script>
<section>
    <form onsubmit={preventDefault}>,
        <input type="hidden" name="action" value="contact">
            <label for="name">Ad Soyad :</label><br>
            <input type="text" id="name" bind:value={name}><br>
            {#if errors.name}<div>{errors.name}</div>{/if}
            <br><br>
            <label for="age">Yaş</label>
            <input type="range" id="age" max="90" min="0"bind:value={age}><input type="number" id="age" bind:value={age}>
            <label for="eposta">E-Posta :</label> <br>
            <input type="email" id="eposta" bind:value={phone}>
            <br><br>
            <label for="phone">Telefon :</label><br>
            <input type="number" id="phone" bind:value={email}>
            <br><br>
            <label for="suggestion">Öneri Başlıkları :</label>
            {#each suggestions as sugg,i}
                <input type="checkbox" name="sugesstions" id="sugg{i}" value={sugg}  bind:group={selectedSuggestions}>
                <label for="sugg{i}">{sugg}</label><br>
            {/each}
            <br><br>
            <label for="message">Eklemek İstedikleriniz :</label><br>
            <textarea id="message" bind:value={message} placeholder="Mesajınız ... "></textarea>
            <button type="submit" onclick={NTSubmit}>GÖnder</button>
    </form>
</section>