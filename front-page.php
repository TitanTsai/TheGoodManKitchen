<?php get_header();?>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">        
    <ol class="carousel-indicators">
        <?php $slider = get_posts(array('post_type' => 'slider', 'posts_per_page' => 3)); ?>
        <?php $count = 0; ?>
        <?php foreach($slider as $slide): ?>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $count; ?>" class="carousel-button  <?php echo ($count == 0) ? 'active' : ''; ?>"></button>
            <?php $count++; ?>
        <?php endforeach; ?>
    </ol>

    <div class="carousel-inner">
        <?php $slider = get_posts(array('post_type' => 'slider', 'posts_per_page' => 3)); ?>
        <?php $count = 0; ?>
        <?php foreach($slider as $slide): ?>
            <div class="carousel-item <?php echo ($count == 0) ? 'active' : ''; ?>">
                <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($slide->ID)) ?>">
            </div>
        <?php $count++; ?>
        <?php endforeach; ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>  

<div class="container-md p-0">
    <section class="frontpage-section" id="news">
        
        <h2 class="frontpage-section_title">最新消息</h2>
        
        <div class="news-container justify-content-left justify-content-md-center">
          <?php $the_query = new WP_Query( 'posts_per_page=3' ); 
            while ($the_query -> have_posts()) : $the_query -> the_post();?>

                <div class="col-6 col-md-3 mb-md-3 mx-2 mx-md-3 news-item">
                    <div class="card news-card h-100" style="border:3px solid;">
                        <img class="card-img" src="<?php the_post_thumbnail_url();?>" alt="">
                        <div class="card-img-overlay">
                            <div class="news-img_mask"></div>
                            <div class="card-content">
                                <h3 class="news-card_topic text-wrap"><?php the_title();?></h3>
                                <a href="<?php the_permalink();?>" class="stretched-link"></a>
                            </div>
                        </div>    
                    </div>
                </div>

            <?php endwhile;wp_reset_postdata();?> 
        </div>
    </section>
</div>

<div class="container">
    <section class="frontpage-section " id="aboutbrand">

        <h2 class="frontpage-section_title">品牌故事</h2>

        <div class="row about_subcontainer d-flex justify-content-center">
            <div class="col-11 col-md-10">
                <h3 class="about_subtitle">關於主廚</h3>
                
                <div class="about_contents text-wrap">
                    <div class="about_image">

                    </div>    
                    <div class="about_contents_text align-self-center">
                    哈囉各位朋友們好，我是Aidan，來自台灣的一位廚師。從小就愛烹飪的我，經過多年的磨練與經驗累積，終於在2019年創立了The Good Man Kitchen。
                    一路上的學習成就了今天的我，特別是在澳洲的七年真的讓我受益良多。在澳洲的這幾年我認識了許多來自各國的廚師及主廚，有來自希臘的行政主廚C先生、土耳其甜點師H小姐和義大利副廚L。
                    這段時間裡每天都是一種挑戰，回台灣時我的A4筆記本已有六本這麼多，我的廚藝各位朋友們吃得出來，健康及新鮮是我一路的原則。
                    </div>    
                </div>
            </div>
          
        </div>

        <div class="row about_subcontainer mt-5 d-flex justify-content-center">
            <div class="col-11 col-md-8 p-3 about_sideborder">
                <span style="font-size:2.5em;font-family:handwrite">舒肥</span> 源自法文「Sous vide 」，直譯是「真空狀態下」的意思，已有40多年歷史。
                不過它的烹調原理卻並非以真空為主軸，而是—溫度。「舒肥」意為「低溫真空烹調」，透過長時間持續、穩定的低溫去加熱的烹飪方法，目的是帶出食材（尤其是肉類）的最佳口感。
                透過對時間與溫度的精準控制，舒肥法能在煮熟食物的同時，減少過度烹煮造成的體積流失，並保留最多的養分與自然風味。除了應用於肉類料理，用來烹製蔬菜和甜點也能收獲絕佳效果。
            </div>
        </div>

    </section>
</div>

<div class="container-md" id="allproducts">
           <h2 class="frontpage-section_title">我們的産品</h2>

        <div class="product-card_horizontalscroll">
            <a href="./product/chicken" class="col-11 col-md-10 ms-3 ms-md-0 product-card_inner" id="#chicken" style="background-color:#F2F2F2;color:#3B4259">
                <div class="row justify-content-center">
                    <div class="col-md-7 order-2 order-md-1">
                        <h5 class="product-card_title">鶏胸</h5>
                        <div class="text-wrap">
                        選用台中大肚山人工養殖的肉雞。堅持使用當天現宰的溫體雞，絕不冷凍，所以口感比一般市售冷凍雞胸再軟嫩多汁。
                        雞胸肉每100公克的熱量為109卡，蛋白質含量24.2公克、脂肪含量0.6公克。其蛋白質比例比牛肉、豬肉、鮭魚、雞蛋還要高，當然是最適合增肌及減脂的肉類。
                        另外還富有維生素A、維生素B群、鈣、磷、鐵、銅等重要營養素、單元不飽和脂肪酸，對於降低總膽固醇也有幫助。
                        </div>
                        <div class="btn btn-dark rounded-pill my-3">更多風味</div>
                    </div>    
                
                    <div class="col-md-3 order-1 order-md-2">
                        <img class="img-fluid product-card_image mx-auto d-block" src="<?php echo get_template_directory_uri(); ?>/assets/images/product-image_chicken.svg" />
                    </div>
                </div>
            </a>

            <a href="./product/beef" class="col-11 col-md-10 product-card_inner" style="background-color:#242424;color:#F2F2F2">
                <div class="row justify-content-center">
                    <div class="col-md-7 order-2 order-md-2">
                        <h5 class="product-card_title">牛排</h5>
                        <div class="text-wrap">
                        嫩肩里肌又稱為板腱，位於上肩胛部位，表面保留部份筋膜及脂肪，美國USDA Choice等級溫體牛肉。
                        牛肉的肌氨酸和蛋白質，都是肌肉合成不可或缺的成分之一，可提供健身者高強度訓練所需的能量。肌氨酸是肌肉燃料之源，有效補充三磷酸腺苷，使健身訓練能堅持得更久，對增長肌肉、增強力量有很好的幫助。
                        而且我們健身蛋白質需求量較大，飲食中需要增加的維生素B6，牛肉中足夠的維生素B6可以促進蛋白質的合成和代謝，能提高免疫力，有助於訓練後身體的恢復。
                        </div>
                        <div class="btn btn-light rounded-pill my-3">更多風味</div>
                    </div>

                    <div class="col-md-3 order-1 order-md-1">
                        <img class="img-fluid product-card_image mx-auto d-block" src="<?php echo get_template_directory_uri(); ?>/assets/images/product-image_beef.svg" />
                    </div>                   
                </div>
            </a>

            <a href="./product/beef" class="col-11 col-md-10 product-card_inner" style="background-color:#B45050;color:#F2F2F2">
                <div class="row justify-content-center">
                    <div class="col-md-7 order-2 order-md-1">
                        <h5 class="product-card_title">鯛魚</h5>
                        <div class="text-wrap">
                        我們的鯛魚來自於嘉義養殖場，新鮮度無庸置疑是最新鮮的。因鯛魚不宜冷藏運送及保存，故選用真空急速冷凍鯛魚片。
                        每100克的鯛魚約有20克的蛋白質、100卡的熱量，加上少量的脂肪又完全無碳水化合物，是非常健康的高蛋白低脂肪食物。
                        </div>

                        <div class="btn btn-dark rounded-pill my-3">更多風味</div>
                    </div>

                    <div class="col-md-3 order-1 order-md-2">
                        <img class="img-fluid product-card_image mx-auto d-block" src="<?php echo get_template_directory_uri(); ?>/assets/images/product-image_fish.svg" />
                    </div>
                </div>
            </a>
            
        </div>

</div>
<div class="container d-flex justify-content-center">
    <section class="frontpage-section col-md-10" id="contactus">
        <h2 class="frontpage-section_title">聯絡我們</h2>
        <div class="row m-1 contact-form_container">
            
            <div class="col-md-6 my-3">
                <form class="p-1 p-md-3" enctype="text/plain" accept-charset="utf-8">
                    <h5 class="mb-3">有疑問嗎？歡迎與我們聯絡</h5>
                    
                    <div class="mb-3">
                        <input type="text" class="form-control" name="Name"  id="nameText" placeholder="您的大名" required>
                    </div>

                    <div class="mb-3">
                        <input type="email" class="form-control" name="Email" id="emailText" placeholder="您的Email" required>
                    </div>

                    <div class="mb-3">
                        <input id="subText" class="form-control" type="text" name="Subject"  value size="60" aria-invalid="false" placeholder="主旨" required>
                    </div>
                   
                    <div class="mb-3">
                        <textarea class="form-control" id="bodyText" name="your-message" rows="5" placeholder="在這裡輸入文字" required></textarea>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-secondary" style="font-weight:300" onclick="submitHandler();"><i class="fas fa-paper-plane"></i> 發送訊息</button>
                        <a id="mailTo"></a>
                    </div>
                </form>   
            </div>
            
            <div class="contact_map col-md-6 mt-3 my-md-5">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3641.582627611611!2d120.67453559205192!3d24.116168902503436!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x34693cfb5646cb93%3A0x2373f2a5baaef5c5!2zNDEy5Y-w5Lit5biC5aSn6YeM5Y2A5rC46ZqG5Lmd6KGXMTAy6Jmf!5e0!3m2!1szh-TW!2stw!4v1614222006688!5m2!1szh-TW!2stw" allowfullscreen="" loading="lazy"></iframe>
            </div>
            
            <div class="text-center">
                <a href="https://www.instagram.com/thegoodmankitchen" class="btn btn-secondary contact_social d-inline-block rounded-circle"><i class="fab fa-instagram"></i></a>
                <a href="https://line.me/ti/p/LDZHItBmGo#~" class="btn btn-secondary contact_social d-inline-block rounded-circle"><i class="fab fa-line"></i></a>
            </div>
        </div>
    </section>
    
    <script>

        var initSubject='',initBody='';

        //按下傳送按鈕後執行
        function submitHandler(){
            var to = "tgmkitchen@gmail.com";//寫死的傳送對象 就是公司的信箱 不會顯示在網頁上
            var name = nameText.value;//讀取ID為 nameTextuser 物件中的值
            var email = emailText.value;
            var subject = subText.value;
        //把user填的資料都塞到 mail body 中
            var body = ""+bodyText.value+'%0A%0A%0A';//%0A是換行 換了三行
                body += "From："+nameText.value+'%0A';
                body += "Email："+emailText.value+'%0A';
        //傳送的主要程式碼
            mailTo.href="mailto:"+to+"?subject="+subject+"&body="+body;
            mailTo.click();
        }
        //在body onload
        function init(){
            subText.value=initSubject;
            toText.value=initTo;
            bodyText.value=initBody;
        }

    </script>
</div>

<?php get_footer();?>