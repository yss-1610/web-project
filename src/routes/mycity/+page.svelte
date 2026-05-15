<script>
	let currentImageIndex = $state(0);
	const images = [
		{ src: '/image/1.jpg', alt: 'Atatürk Köşkü' },
		{ src: '/image/2.jpg', alt: 'Trabzon Ayasofya' },
		{ src: '/image/3.jpg', alt: 'Sümela Manastırı' },
		{ src: '/image/4.jpg', alt: 'Uzungöl' }
	];

	function nextImage() {
		currentImageIndex = (currentImageIndex + 1) % images.length;
	}

	function prevImage() {
		currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
	}
</script>

<article class="city-article">
	<h1 class="article-title">Trabzon</h1>

	<section class="intro-section mb-4">
		<p>
			Trabzon, Türkiye'nin Doğu Karadeniz Bölgesinde yer alırken aynı zamanda Karadeniz'e kıyısı bulunur.
			Bölgenin coğrafi yapısından kaynaklı yüksek yağış oranına sahiptir. Günümüzde bölgede Samsun'dan sonra ikinci en büyük kenttir.
			Tarihte birçok çağdan yaşam izleri barındıran şehir, özellikle Roma ve Osmanlı dönemlerinde günümüzdeki kültürel ve mimari yapısını oluşturmuştur.
			"Şehzadeler şehri" olarak anılan bu şehir için Evliya Çelebi şöyle demiştir: "Bu şehre küçük İstanbul denilse yeridir. İrem bağları gibi süslü bir şehirdir burası."
		</p>
	</section>

	<section class="place-section">
		<div class="row align-items-start g-4">
			<div class="col-md-4">
				<div class="place-image">
					<img src="/image/1.jpg" alt="Atatürk Köşkü">
				</div>
			</div>
			<div class="col-md-8">
				<div class="place-text">
					<h2>Atatürk Köşkü</h2>
					<p>Soğuksu semtinde çam ormanları içerisinde yer alan bu zarif köşk, 19. yüzyılın sonlarında inşa edilmiştir. Avrupa mimarisinin izlerini taşıyan yapı, Mustafa Kemal Atatürk'ün Trabzon'u ziyaretlerinde konakladığı ve vasiyetini yazdığı yer olarak hem tarihi hem de manevi açıdan büyük bir öneme sahiptir.</p>
				</div>
			</div>
		</div>
	</section>

	<section class="place-section">
		<div class="row align-items-start g-4">
			<div class="col-md-4">
				<div class="place-image">
					<img src="/image/2.jpg" alt="Trabzon Ayasofya">
				</div>
			</div>
			<div class="col-md-8">
				<div class="place-text">
					<h2>Ayasofya Camii ve Müzesi</h2>
					<p>13. yüzyılda Trabzon İmparatorluğu krallarından I. Manuel Komnenos döneminde inşa edilen Ayasofya, Geç Bizans kiliselerinin en güzel örneklerinden biridir. Taş işçiliği, kabartmaları ve içindeki tarihi freskleriyle dikkat çeken yapı, Trabzon'un çok kültürlü tarihi geçmişinin en canlı şahitlerindendir.</p>
				</div>
			</div>
		</div>
	</section>

	<section class="place-section">
		<div class="row align-items-start g-4">
			<div class="col-md-4">
				<div class="place-image">
					<img src="/image/3.jpg" alt="Sümela Manastırı">
				</div>
			</div>
			<div class="col-md-8">
				<div class="place-text">
					<h2>Sümela Manastırı</h2>
					<p>Altındere Vadisi'nin nefes kesici manzarasına hakim, sarp bir kayalığa oyulmuş olan Sümela Manastırı, adeta yerçekimine meydan okur. 4. yüzyılda kurulduğuna inanılan bu efsanevi yapı, zengin freskleri ve eşsiz mimarisiyle sadece Türkiye'nin değil, dünyanın da en önemli inanç turizmi merkezlerinden biridir.</p>
				</div>
			</div>
		</div>
	</section>

	<section class="place-section">
		<div class="row align-items-start g-4">
			<div class="col-md-4">
				<div class="place-image">
					<img src="/image/4.jpg" alt="Uzungöl">
				</div>
			</div>
			<div class="col-md-8">
				<div class="place-text">
					<h2>Uzungöl</h2>
					<p>Trabzon'un doğal güzellikleri denilince akla ilk gelen yer şüphesiz Uzungöl'dür. Haldizen Deresi'nin önünün heyelan sonucu kapanmasıyla oluşan bu set gölü; dik yamaçları, sık çam ormanları ve temiz havasıyla ziyaretçilerine huzur dolu bir doğa deneyimi sunar.</p>
				</div>
			</div>
		</div>
	</section>

	<section class="gallery-section">
		<h2>Galeri</h2>
		<div class="gallery-viewer">
			<img src={images[currentImageIndex].src} alt={images[currentImageIndex].alt}>
		</div>
		<div class="gallery-controls">
			<button class="gallery-btn" onclick={prevImage}>‹</button>
			<span class="gallery-counter">{currentImageIndex + 1} / {images.length}</span>
			<button class="gallery-btn" onclick={nextImage}>›</button>
		</div>
		<div class="gallery-thumbnails">
			{#each images as image, index}
				<button
					class="thumbnail {index === currentImageIndex ? 'active' : ''}"
					onclick={() => currentImageIndex = index}
				>
					<img src={image.src} alt={image.alt}>
				</button>
			{/each}
		</div>
	</section>
</article>
