<script>
    import { page } from '$app/state';
    
    const ogrenciNo = $derived(page.url.searchParams.get('ogrNo'));
</script>

<main>
    {#if ogrenciNo}
        <h1>Hoşgeldiniz {ogrenciNo}</h1>
        <a href="/login">Çıkış Yap (Giriş Sayfasına Dön)</a>
    {:else}
        <h1>Yetkisiz Erişim</h1>
        <p>Lütfen önce giriş yapın.</p>
        <a href="/login">Giriş Sayfasına Git</a>
    {/if}
</main>