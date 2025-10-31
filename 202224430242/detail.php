
<?php
session_start();
$characters = [
    'zanghai' => '藏海/稚奴',
    'xiangantu' => '香暗荼',
    'gaoming' => '高明',
    'zhaobingwen' => '赵秉文',
    'zhaoshangxian' => '赵上弦',
    'zhuangzhixing' => '庄之行'
];

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>藏海传人物介绍 </title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Microsoft YaHei", "PingFang SC", sans-serif;
        }
        body {
            background-color: #f8f5f0;
            color: #333;
            line-height: 1.8;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
        .header {
            background: linear-gradient(135deg, #2c3e50, #4a6491);
            color: white;
            padding: 20px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .header h1 {
            font-size: 2.8rem;
            margin-bottom: 10px;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        
        
        .user-welcome {
            color: white;
            margin-right: 15px;
            font-size: 0.95rem;
        }
        
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }
      
        .page-title {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }
        .page-title h2 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 15px;
        }
        
        
       
        .characters-section {
            margin-bottom: 50px;
        }
        .character-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
        }
        .character-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .character-image {
            height: 250px;
            background-size: cover;
            background-position: center;
            position: relative;
        }
        
        .character-name {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: white;
            font-size: 1.8rem;
            z-index: 1;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        }
        .character-jieshao {
            padding: 20px;
        }
       
       
        .social-media {
            margin-top: 15px;
            font-size: 0.9rem;
            color: #bdc3c7;
        }
       
        .gallery-image {
            cursor: pointer; 
            transition: transform 0.3s; 
        }
        .gallery-image:hover {
            transform: scale(1.03);
        }
        
.zang1 {
    display: inline-block;
    padding: 10px 20px;
    background: #2c3e50;
    color: white;
    text-decoration: none;
    border-radius: 4px;
}
.zang1:hover {
    background: #FEC601;
}
            
    </style>
</head>
<body>
  
    <header class="header">
        <h1>藏海传</h1>
        <div class="zang1">
                <a href="zang1.php">返回首页</a>
            </div>
    </header>
    <div class="container">
        
        <div class="page-title">
            <h2>主要人物介绍</h2>
        </div>
       
        <div class="divider"></div>
     
        <div class="characters-section">
            <div class="character-cards">
            
                <div class="character-card">
                <a href="character-detial.php?id=zanghai">
                
                    <div class="character-image" style="background-image: url('pictrue/zanghai.jpg');">
                        <h3 class="character-name">藏海/稚奴</h3>
                    </div>
                    </a>
                    <div class="character-jieshao">
                        <p>藏海原名稚奴，是大雍国钦天监监正蒯铎之子。在经历家族惨遭灭门的悲剧后，他背负着血海深仇，隐姓埋名并学习营造技艺与纵横之术。</p>
                      <p>  十年后，藏海化名重回京城，掀起了一场风云巨变。他凭借智慧在权力的漩涡中周旋，不仅成为钦天监监正，更是大雍国的首席科学家，并逐渐升至内阁首辅的位置。</p>
                        <p>当他有机会复仇时，却发现阴谋背后还有更大的秘密。最终，他选择揭破阴谋，并与挚爱和朋友们一起保卫国家。</p>
                    </div>
                </div>
                
                <div class="character-card">
                <a href="character-detial.php?id=xiangantu">
                    <div class="character-image" style="background-image: url('pictrue/xiangantu.jpg');">
                        <h3 class="character-name">香暗荼</h3>
                    </div>
                    </a>
                    <div class="character-jieshao">
                        <p>香暗荼是一位身世神秘、聪明伶俐且身怀绝技的女孩，在剧中拥有独立成长轨迹和使命。</p>
                        <p>她与男主角藏海的相遇充满戏剧性，起初因各自目的而相互利用，但在共同面对复仇路上的困难和挑战时，逐渐加深理解和信任。</p>
                       <p> 两人共同经历了一系列事件后，感情升温，不仅成为彼此坚实的后盾，还共同面对家国命运和个人情感之间的矛盾与挣扎。</p>
                        <p>最终，香暗荼不仅完成了自己的使命，还收获了真挚的爱情和友情</p>
                    </div>
                </div>
         
                <div class="character-card">
                 <a href="character-detial.php?id=gaoming">
                    <div class="character-image" style="background-image: url('pictrue/gaoming.jpg');">
                        <h3 class="character-name">高明</h3>
                    </div>
                </a>
                    <div class="character-jieshao">
                        <p>高明表面上是一个玩世不恭、幽默风趣的谋士，擅长纵横之术。</p>
                      <p>  他在藏海幼年灭门后，带他隐姓埋名，悉心教导他各种技能，成为藏海命运中重要的守护者。</p>
                        <p>高明不仅传授知识，还在生活中给予藏海关爱和支持，让藏海逐渐掌握了纵横捭阖的精妙门道。</p>
                    </div>
                </div>
           
                <div class="character-card">
                  <a href="character-detial.php?id=zhaobingwen">
                    <div class="character-image" style="background-image: url('pictrue/zhaobingwen.jpg');">
                        <h3 class="character-name">赵秉文</h3>
                    </div>
                   </a>
                    <div class="character-jieshao">
                        <p>赵秉文是电视剧《藏海传》的虚构角色，角色形象被描述为“对弈求理，拘于迷境之潭”。饰演者为田小洁。</p>
                    </div>
                </div>
                <div class="character-card">
                   <a href="character-detial.php?id=zhaoshangxian">
                    <div class="character-image" style="background-image: url('pictrue/zhaoshangxian.jpg');">
                        <h3 class="character-name">赵上弦</h3>
                    </div>
                    </a>
                    <div class="character-jieshao">
                        <p>赵上弦是藏海（原名稚奴）的母亲，是一个温柔贤淑、临危不惧的女子。其角色定位是 “莲生求安，毅于困顿之际”。</p>
                        <p>赵上弦的身份神秘，她背后牵扯着家族的隐秘秘密，与朝堂权谋博弈息息相关。</p>
                        <p>在藏海幼年时，她是藏海温暖的港湾，然而后来藏海家族遭遇变故，一夜之间家破人亡，身负血海深仇，赵上弦应该也经历了许多苦难。</p>
                    </div>
                    </div>
                     <div class="character-card">
                       <a href="character-detial.php?id=zhuangzhixing">
                    <div class="character-image" style="background-image: url('pictrue/zhuangzhixing.jpg');">
                        <h3 class="character-name">庄之行</h3>
                    </div>
                 </a>
                    <div class="character-jieshao">
                        <p>庄之行是电视剧《藏海传》中平津侯庄芦隐的幼子，表面以"侯府废物二公子"身份伪装纨绔，实则因幼年目睹生母遭嫡母毒害而隐忍蛰伏十余年。</p>
                        <p>他通过藏海背部的十字伤痕识破其蒯家遗孤身份后，选择暗中协助对方实施复仇计划，在发现父亲默许母亲被害真相后，联合藏海颠覆家族权势。</p>
                        <p>该角色最终继承平津侯爵位，成为剧中平衡权谋斗争与国家大义的关键人物。</p>

                    </div>
                    </div>  
            </div>
        </div>
    </div>
</body>
</html>

