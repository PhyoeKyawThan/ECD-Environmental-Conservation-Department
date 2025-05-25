<?php
require_once __DIR__ . '/../../models/MediaModel.php';
$media = new MediaModel();
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
            width: 100%;
            display: flex;
            /* background-color: var(--primary-color); */
            flex-direction: row-reverse;
            align-items: center;
            justify-content: space-between;
            margin: 20px auto;
            border-bottom: 1px solid var(--secondary-color);
        }

        #media .item div:last-child {
            width: 100%;
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

        #media .item .date {
            padding: 10px;
        }
    </style>
    <div id="media">
        <?php
        foreach ($media->get_all() as $m):
            $uploaded_at = new DateTime($m["uploaded_at"]);
            ?>
            <div class="item">
                <div>
                    <img src="../../static/images/Logo_of_Ministry_of_Natural_Resources_and_Environmental_Conservation_(Myanmar).png"
                        alt="" srcset="">
                </div>
                <div>
                    <a href="?n=<?= $m["title"] ?>" class="title"><?= $m["title"] ?></a>
                    <a href="/<?= $m["category_slug"] ?>" class="category"><?= $m["category_name"] ?></a>
                    <br>
                    <span class="date"><?= $uploaded_at->format("F j, Y") ?></span>
                </div>
            </div>
        <?php endforeach; ?>

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