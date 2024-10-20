<div class="read-me-section">
    <h1 class="title">Pendik Anadolu Lisesi - Read Me</h1>
    
    <!-- Arka Plan GIF -->
    <div class="background-gif">
        <img src="your-gif-link.gif" alt="Background Animation">
    </div>

    <!-- Yazı İçeriği -->
    <div class="content">
        <p>Bu okul, benim hem akademik hem de kişisel gelişimimde önemli bir yer kapladı. Bilim ve teknolojiye olan ilgim burada filizlendi ve farklı projelerle bunu daha ileriye taşıdım.</p>
        
        <!-- Kişisel Başarılar -->
        <p class="highlight">
            <span>En İyi Deneyimim:</span> 
            <br> Yapay zeka ve yazılım projelerinde yer almak, en unutulmaz anlarımdan biri oldu.
        </p>
        <p class="highlight">
            <span>En İlginç Projem:</span>
            <br> "Pal-E-Dergi" platformunu kurarak, sürekli gelişen bir dijital dergi oluşturdum.
        </p>
    </div>

    <!-- Hover ile Hareketlenen Resim -->
    <div class="image-hover">
        <img src="image.jpg" alt="Pendik Anadolu Lisesi" class="hover-image">
    </div>
</div>
<script>
  .read-me-section {
    position: relative;
    padding: 20px;
    text-align: center;
    color: #fff;
    font-family: 'Arial', sans-serif;
    background-color: rgba(0, 0, 0, 0.7); /* Arka planı hafif opak yapar */
    border-radius: 10px;
}

.title {
    font-size: 2.5rem;
    margin-bottom: 20px;
}

.background-gif {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    overflow: hidden;
    border-radius: 10px;
}

.background-gif img {
    width: 100%;
    height: auto;
    opacity: 0.6; /* GIF'i hafif transparan yapar */
}

.content {
    z-index: 2;
    position: relative;
    animation: fadeIn 2s ease-in-out;
}

.highlight {
    background: rgba(255, 255, 255, 0.2);
    padding: 10px;
    margin-top: 15px;
    border-radius: 8px;
    font-size: 1.2rem;
}

.highlight span {
    font-weight: bold;
    color: #4CAF50; /* Vurgulanan yazılar için renk */
}

/* Hover ile Hareketlenen Resim */
.image-hover {
    margin-top: 30px;
    animation: bounce 4s infinite;
}

.hover-image {
    width: 200px;
    border-radius: 50%;
    transition: transform 0.3s;
}

.hover-image:hover {
    transform: scale(1.2); /* Resmi hover ile büyütme efekti */
}

/* Fade-in animasyonu */
@keyframes fadeIn {
    0% { opacity: 0; }
    100% { opacity: 1; }
}

/* Resim için hafif zıplama efekti */
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

</script>
