<script>
	// import '../index.css';
	let { children } = $props();
</script>

<nav>
	<a href="/">Ana Sayfa</a>
	<a href="/interest">API</a>
	<a href="/cv">CV</a>
	<a href="/contact">İletişim</a>
	<a href="/mycity">Şehrim</a>
	<a href="/login">Giriş</a>
</nav>

<main>
	{@render children()}
</main>

<footer>web-project</footer>

