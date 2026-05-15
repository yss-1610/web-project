<script>
	import '../index.css';
	let { children } = $props();
</script>

<nav class="layout-nav">
	<div class="container">
		<div class="nav-bar">
			<a class="nav-icon" href="/">
				<img src="/image/icon/favicon-32x32.png" alt="icon">
			</a>
			<div class="nav-links">
				<a href="/club">TS</a>
				<a href="/interest">API</a>
				<a href="/cv">CV</a>
				<a href="/contact">İletişim</a>
				<a href="/mycity">Şehrim</a>
			</div>
			<a class="nav-login" href="/login">Giriş</a>
		</div>
	</div>
</nav>

<main class="container">
	{@render children()}
</main>

<footer class="layout-footer">web-project</footer>
