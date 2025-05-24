<?php
if (isset($_GET["n"])) {
    require_once __DIR__ . '/viewsMedia.php';
} else {
    ?>

    <style>
        #media {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        #media .item {
            width: fit-content;
            display: flex;
            /* background-color: var(--primary-color); */
            flex-direction: row-reverse;
            justify-content: start;
            margin:20px auto;
            border-bottom: 1px solid var(--secondary-color);
        }

        #media .item .title {
            display: block;
            font-size: var(--font-size-base);
            font-weight: 600;
            color: var(--font-color-primary, #fff);
            text-decoration: none;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.5;
            padding: 10px;
        }
        #media .item .title:hover {
            text-decoration: underline;
        }

        #media .item img {
            margin-left: 20px;
            width: 80px;
            height: 100px;
        }

        #media .category {
            float: right;
            background-color: var(--secondary-color, #2a2a2a);
            padding: 2px 8px;
            border-radius: 4px;
            text-decoration: none;
            color: #fff;
            font-size: var(--font-size-sm, 14px);
            margin: 10px auto;
        }

        #media .category:hover {
            background-color: var(--primary-color, #4CAF50);
        }

        #media .item .date{
            padding: 10px;
        }
    </style>
    <div id="media">
        <?php
            $media = new MediaModel();
            foreach($media-> as $media)
        ?>
        <div class="item">
            <div>
                <img src="../../static/images/Logo_of_Ministry_of_Natural_Resources_and_Environmental_Conservation_(Myanmar).png"
                    alt="" srcset="">
            </div>
            <div>
                <a href="?n=အမျိုးသားအဆင့်" class="title">အမျိုးသားအဆင့် သန့်ရှင်း၍စိမ်းလန်းစိုပြည်သောအကောင်းဆုံးကျောင်းဆု
                    ရရှိခဲ့သည့်
                    ကျောင်းများအမည်စာရင်း ထုတ်ပြန်ခြင်း</a>
                <a href="/media" class="category">သတင်းနှင့်မီဒီယာ</a>
                <br>
                <span class="date">May 20, 2025</span>
            </div>
        </div>

        <!-- <div class="item">
            <div>
                <img src="../../static/images/Logo_of_Ministry_of_Natural_Resources_and_Environmental_Conservation_(Myanmar).png"
                    alt="" srcset="">
            </div>
            <div>
                <a href="?n=အမျိုးသားအဆင့်" class="title">အမျိုးသားအဆင့် သန့်ရှင်း၍စိမ်းလန်းစိုပြည်သောအကောင်းဆုံးကျောင်းဆု
                    ရရှိခဲ့သည့်
                    ကျောင်းများအမည်စာရင်း ထုတ်ပြန်ခြင်း</a>
                <a class="category">သတင်းနှင့်မီဒီယာ</a>
                <br>
                <span class="date">May 20, 2025</span>
            </div>
        </div>

        <div class="item">
            <div>
                <img src="../../static/images/Logo_of_Ministry_of_Natural_Resources_and_Environmental_Conservation_(Myanmar).png"
                    alt="" srcset="">
            </div>
            <div>
                <a href="?n=အမျိုးသားအဆင့်" class="title">အမျိုးသားအဆင့် သန့်ရှင်း၍စိမ်းလန်းစိုပြည်သောအကောင်းဆုံးကျောင်းဆု
                    ရရှိခဲ့သည့်
                    ကျောင်းများအမည်စာရင်း ထုတ်ပြန်ခြင်း</a>
                <a class="category">သတင်းနှင့်မီဒီယာ</a>
                <br>
                <span class="date">May 20, 2025</span>
            </div>
        </div>

        <div class="item">
            <div>
                <img src="../../static/images/Logo_of_Ministry_of_Natural_Resources_and_Environmental_Conservation_(Myanmar).png"
                    alt="" srcset="">
            </div>
            <div>
                <a href="?n=အမျိုးသားအဆင့်" class="title">အမျိုးသားအဆင့် သန့်ရှင်း၍စိမ်းလန်းစိုပြည်သောအကောင်းဆုံးကျောင်းဆု
                    ရရှိခဲ့သည့်
                    ကျောင်းများအမည်စာရင်း ထုတ်ပြန်ခြင်း</a>
                <a class="category">သတင်းနှင့်မီဒီယာ</a>
                <br>
                <span class="date">May 20, 2025</span>
            </div>
        </div>

        <div class="item">
            <div>
                <img src="../../static/images/Logo_of_Ministry_of_Natural_Resources_and_Environmental_Conservation_(Myanmar).png"
                    alt="" srcset="">
            </div>
            <div>
                <a href="?n=အမျိုးသားအဆင့်" class="title">အမျိုးသားအဆင့် သန့်ရှင်း၍စိမ်းလန်းစိုပြည်သောအကောင်းဆုံးကျောင်းဆု
                    ရရှိခဲ့သည့်
                    ကျောင်းများအမည်စာရင်း ထုတ်ပြန်ခြင်း</a>
                <a class="category">သတင်းနှင့်မီဒီယာ</a>
                <br>
                <span class="date">May 20, 2025</span>
            </div>
        </div> -->
    </div>
<?php } ?>