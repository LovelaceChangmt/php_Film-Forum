<?php 
$bannerImages = [
    "pictrue/lunbo1.jpg",
    "pictrue/lunbo2.jpg",
   
];


?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>欢迎登陆首页</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #ffebcd;
    }

    .container {
      width: 80%;
      margin: auto;
      overflow: hidden;
    }

    header {
      background-color: darkred;
      padding: 1rem 2rem;
    }

    .nav-container {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }


    .left-title {
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .welcome {
      font-size: 1.5rem;
      font-weight: bold;
      color: #fff;
      text-decoration: none;
      margin-bottom: 0.3rem;
    }

    .subtitle {
      font-size: 1rem;
      color: #fff;
      margin: 0;
    }

  
    .links {
      list-style: none;
      display: flex;
      gap: 1.5rem;
      align-items: center;
    }

    .links li a {
      color: #fff;
      text-decoration: none;
      transition: color 0.3s;
    }

    .links li a:hover {
      color: #ffd700;
    }
   .banner {
            position: relative;
            max-width: 1000px;
            margin: 1rem auto;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            aspect-ratio: 16/9;
        }


        .banner-slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
            height: 100%;
        }

        .banner-slides img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            flex-shrink: 0;
            background-color: #000;
        }


  
        .banner-controls {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
            padding: 0 1rem;
        }

        .banner-controls button {
            background-color: rgba(255,255,255,0.5);
            border: none;
            outline: none;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .banner-controls button:hover {
            background-color: rgba(255,255,255,0.8);
        }


    .main-content {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 0 1rem;
    }

    .welcome-section {
      text-align: center;
      margin-bottom: 2rem;
    }

    .welcome-title {
      font-size: 2rem;
      color: #8b4513;
      margin-bottom: 1rem;
    }

    .content-section {
      background-color: white;
      padding: 2rem;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      margin-bottom: 2rem;
    }

    .gallery-section {
      text-align: center;
    }

    .gallery-title {
      text-align: center;
      font-size: 1.5rem;
      color: #8b4513;
      margin-bottom: 1rem;
    }

    .gallery-image {
      max-width: 33%;
      height: auto;
      border-radius: 5px;
      margin-bottom: 1rem;
    }
  </style>
</head>

<body>

  <header>
    <div class="nav-container">
     
      <div class="left-title">
        <a class="welcome">欢迎</a>
        <p class="subtitle">藏海无舟 众生皆溺</p>
      </div>

      <ul class="links">
        <li><a href="detail.php">了解更多</a></li>
        <li><a href="cpguangchang.php">cp广场</a></li>
        <li><a href="login.php">退出登录</a></li>
      </ul>
    </div>
  </header>

    <div class="banner">
        <div class="banner-slides">
            <?php foreach ($bannerImages as $img): ?>
                <img src="<?php echo $img; ?>" alt="Banner Image">
            <?php endforeach; ?>
        </div>
   
        <div class="banner-controls">
            <button id="prevBtn">&lt;</button>
            <button id="nextBtn">&gt;</button>
        </div>
    </div>

  <div class="main-content">
    <section class="welcome-section">
      <h3 class="welcome-title">藏海传</h3>
      <h4>欢迎加入藏海的复仇计划</h4>
    </section>
    <section class="content-section">
      <p>大雍国钦天监监正蒯铎之子稚奴一夜之间全家被灭，他收敛锋芒，学习营造技艺与纵横之术。十年后他化名藏海回到京城，向仇人平津侯示好。</p>
      <p>为了赢得平津侯的信任，他为平津侯解决了帝后合葬等诸多难题。此后，藏海一步步入朝为官，成为了新一任钦天监监正。他精心谋划，让平津侯及当年凶案党羽尽数伏法。</p>
      <p>首辅石怀山想要发动战争，消灭冬夏等周边国家。为了国家和百姓免受战争纷扰，藏海和庄之行、香温偃月等人一起阻止了石怀山，化解了大雍和他国之间的战争。</p>
    </section>
    <section class="gallary-section">
      <h5 class="gallery-title">精彩剧照</h5>
      <img src="pictrue/2.jpg" alt="藏海传剧照" class="gallery-image">
      <img src="pictrue/3.jpg" alt="藏海传剧照" class="gallery-image">
      <img src="pictrue/4.jpg" alt="藏海传剧照" class="gallery-image">
      <img src="pictrue/5.jpg" alt="藏海传剧照" class="gallery-image">
      <img src="pictrue/6.jpg" alt="藏海传剧照" class="gallery-image">
      <img src="pictrue/7.jpg" alt="藏海传剧照" class="gallery-image">
    </section>
  </div>

    <script>

        const slidesContainer = document.querySelector('.banner-slides');
        const slides = document.querySelectorAll('.banner-slides img');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        let currentSlide = 0;
        const slideWidth = slides[0].clientWidth;
        const autoPlayInterval = 5000; 

    
        slidesContainer.style.transform = `translateX(-${currentSlide * slideWidth}px)`;


        function goToSlide(index) {
            currentSlide = index;
            slidesContainer.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
        }

        let autoPlay = setInterval(() => {
            goToSlide((currentSlide + 1) % slides.length);
        }, autoPlayInterval);

     
        nextBtn.addEventListener('click', () => {
            goToSlide((currentSlide + 1) % slides.length);
            resetAutoPlay();
        });

        prevBtn.addEventListener('click', () => {
            goToSlide((currentSlide - 1 + slides.length) % slides.length);
            resetAutoPlay();
        });



        function resetAutoPlay() {
            clearInterval(autoPlay);
            autoPlay = setInterval(() => {
                goToSlide((currentSlide + 1) % slides.length);
            }, autoPlayInterval);
        }
    </script>
</body>
</html>