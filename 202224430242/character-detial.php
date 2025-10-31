<?php
session_start();
$characterId = $_GET['id'] ?? '';

$characters = [
    'zanghai' => [
        'name' => '肖战',
        'image' => 'pictrue/xiaozhan.jpg',
        'xingzuo' => '天秤座' ,
        'biyeyuanxiao' => '重庆工商大学',
        'daibiaozuo' => '《陈情令》《王牌部队》《骄阳伴我》',
        'description' => '肖战，1991年10月5日出生于重庆市，中国内地男演员、歌手。2015年，以选手身份参加浙江卫视才艺养成选秀节目《燃烧吧少年》从而正式出道。',
    ],


    'xiangantu' => [
        'name' => '张婧仪',
        'image' => 'pictrue/zhangjingyi.jpg',
        'xingzuo' => '巨蟹座',
        'biyeyuanxiao'=>'北京电影学院',
        'daibiaozuo'=>'《我要我们在一起》《人生路不熟》',
        'description' => '张婧仪，2000年7月10日出生于湖南省邵阳市，中国内地女演员，毕业于北京电影学院2018级表演系本科班。2018年，签约由陈坤、周迅共同创立的东申未来演艺经纪公司。',
    ],

    'gaoming' => [
        'name' => '张婧仪',
        'image' => 'pictrue/liangchao.jpg',
        'xingzuo' => '巨蟹座',
        'biyeyuanxiao'=>'北京电影学院',
        'daibiaozuo'=>'《我要我们在一起》《人生路不熟》',
        'description' => '，2000年7月10日出生于湖南省邵阳市，中国内地女演员，毕业于北京电影学院2018级表演系本科班。2018年，签约由陈坤、周迅共同创立的东申未来演艺经纪公司。',
    ],
    'zhaobingwen' => [
        'name' => '张婧仪',
        'image' => 'pictrue/tianxiaojie.jpg',
        'xingzuo' => '巨蟹座',
        'biyeyuanxiao'=>'北京电影学院',
        'daibiaozuo'=>'《我要我们在一起》《人生路不熟》',
        'description' => '田小洁，2000年7月10日出生于湖南省邵阳市，中国内地男演员，毕业于北京电影学院2018级表演系本科班。2018年，签约由陈坤、周迅共同创立的东申未来演艺经纪公司。',
    ],
    'zhaoshangxian' => [
        'name' => '陈妍希',
        'image' => 'pictrue/chenyanxi.jpg',
        'xingzuo' => '巨蟹座',
        'biyeyuanxiao'=>'加利福尼亚学院',
        'daibiaozuo'=>'《我要我们在一起》《人生路不熟》',
        'description' => '陈妍希，2000年7月10日出生于湖南省邵阳市，中国内地女演员，毕业于北京电影学院2018级表演系本科班。2018年，签约由陈坤、周迅共同创立的东申未来演艺经纪公司。',
    ],
    'zhuangzhixing' => [
        'name' => '周奇',
        'image' => 'pictrue/zhouqi.jpg',
        'xingzuo' => '巨蟹座',
        'biyeyuanxiao'=>'北京电影学院',
        'daibiaozuo'=>'《我要我们在一起》《人生路不熟》',
        'description' => '周奇’，2000年7月10日出生于湖南省邵阳市，中国内地男演员，毕业于北京电影学院2018级表演系本科班。2018年，签约由陈坤、周迅共同创立的东申未来演艺经纪公司。',
    ],
    
];



$character = $characters[$characterId] ?? null;

if (!$character) {
    header("Location: character-detial.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($character['name']) ?> 演员介绍</title>
   <style>
        body {
            background-color: #f8f5f0;
            color: #333;
            font-family: "Microsoft YaHei", "PingFang SC", sans-serif;
        }
        .detail-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .character-container{
        	width:800px;
        	margin:0 auto;
        	padding:20px;
        }
        .character-image{
        	wide:100%;
        	height:400px;
        	object-fit:cover;
        	border-radius:8px;
        	box-shadow:0 4px 8px rgba(0,0,0,0.1);
        }
        .back-link {
            display: inline-block;
            margin-top: 10px;
            color: #2c3e50;
            text-decoration: underline;
        }
.info-item {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .info-item:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: bold;
            color: #555;
            margin-right: 10px;
        }
        
.back-button {
    display: inline-block;
    padding: 10px 20px;
    background: #2c3e50;
    color: white;
    text-decoration: none;
    border-radius: 4px;
}
.back-button:hover {
    background: #4a6491;
}
    </style>
</head>
<body>
    <header class="header">
        <h1><?= htmlspecialchars($character['name']) ?></h1>
    </header>
    
 <div class="container detail-container">
        <div class="character-detail">
            <div class="character-image" style="background-image: url('<?= htmlspecialchars($character['image']) ?>');"></div>
              <div class="character-info">
                <div class="info-item">
                    <span class="info-label">姓名：</span>
                    <?= htmlspecialchars($character['name']) ?>
                </div>
                <div class="info-item">
                    <span class="info-label">星座：</span>
                    <?= htmlspecialchars($character['xingzuo']) ?>
                </div>
                <div class="info-item">
                    <span class="info-label">毕业院校：</span>
                    <?= htmlspecialchars($character['biyeyuanxiao']) ?>
                </div>
                <div class="info-item">
                    <span class="info-label">代表作：</span>
                    <?= htmlspecialchars($character['daibiaozuo']) ?>
                </div>
                <div class="info-item">
                    <span class="info-label">简介：</span>
                    <p><?= nl2br(htmlspecialchars($character['description'])) ?></p>
                </div>
                <div class="back-button-container">
                 <a href="detail.php" class="back-button">返回</a>
            </div>
        </div>
    </div>
    
</body>
</html>
