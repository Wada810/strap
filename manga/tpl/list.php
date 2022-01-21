<!DOCTYPE html>
<html lang="ja" theme="<?php print $theme;?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/destyle.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>マンガ一覧</title>
</head>
<body>
    <div id="comp_msg" class="<?php print $comp_hidden;?>"><?php print $comp_msg;?><span class="material-icons" id="comp_msg_close">close</span></div>
    <setion id="data_list">
        <table>
        <thead>
            <tr>
                <td>
                    <div id="title"><h1>単行本一覧</h1></div>
                    <form method="post" id="form">
                        <div id="search_box"><button><span class="material-icons">search</span></button><input type="text" name="search" placeholder="タイトルを検索"></div>
                        <div id="narrow_down">
                            <?php foreach($filters as $filter){?>
                                <span><label><p><?php print $filter[0];?></p><button name="filter_delete" value="<?php print $filter[2];?>"><span class="material-icons">close</span></button></label></span><?php
                            }?>

                            <br>
                            <span id="filter_box">
                                <span class="material-icons">add</span>
                                <ul id="add_filter" class="hidden">
                                    <li class="title">
                                        <p>タイトル</p>
                                        <ul class="hidden">
                                            <li>
                                                <div class="select">
                                                    <select name="title_advanced_search_type">
                                                        <option value="and">AND</option>
                                                        <option value="or">OR</option>
                                                        <option value="not">NOT</option>
                                                    </select>
                                                </div>
                                                <div class="input_box"><input class="num" type="text" name="title_advanced_search"></div>
                                            </li>
                                            <li><button class="apply" name="filter" value="apply">適用する</button></li>
                                        </ul>
                                    </li>
                                    <li class="volume">
                                        <p>巻数</p>
                                        <ul class="hidden">
                                            <li>
                                                <div class="select">
                                                    <select name="volume_search_type" id="volume_search_type">
                                                        <option value="more">以上</option>
                                                        <option value="less">以下</option>
                                                        <option value="match">一致</option>
                                                        <option class="range" value="range">範囲</option>
                                                    </select>
                                                </div>
                                                <div class="input_box"><input class="num" type="number" min="0" name="volume_search"><span>巻</span></div>
                                            </li>
                                            <li><button class="apply" name="filter" value="apply">適用する</button></li>
                                        </ul>
                                    </li>
                                    <li class="price">
                                        <p>価格</p>
                                        <ul class="hidden">
                                            <li>
                                                <div class="select">
                                                    <select name="price_search_type" id="price_search_type">
                                                        <option value="more">以上</option>
                                                        <option value="less">以下</option>
                                                        <option value="match">一致</option>
                                                        <option class="range" value="range">範囲</option>
                                                    </select>
                                                </div>
                                                <div class="input_box"><input class="num" min="0" type="number" name="price_search"><span>円</span></div>
                                            </li>
                                            <li><button class="apply" name="filter" value="apply">適用する</button></li>
                                        </ul>
                                    </li>
                                </ul>
                            </span>

                        </div>
                        <div id="search_result">
                            <div><?php print $first_row;?>&sim;<?php print $last_row;?>件 &frasl; 全<?php print count($books);?>件</div>
                            <div id="setting_box">
                                <div id="settings">表示設定<span id="setting_icon" class="material-icons">settings</span></div>
                                <ul id="setting_list" class="hidden">
                                    <li><span id="dark_mode" class="toggle <?php print ($theme == "dark")? "" : "toggle_off" ;?>">ダークモード</span></li>
                                    <li><span id="image_visibility" class="toggle <?php print ($visibility == "invisible")? "" : "toggle_off";?>">表紙の画像を非表示にする</span></li>
                                    <li class="no_hov">
                                        <div>
                                            1ページに表示する行数
                                            <div class="select">
                                                <select name="rows_per_page" id="rows_per_page" onChange="submit(this.form)">
                                                    <?php print gen_options($options,$rpp);?>
                                                </select>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <div class="arrows"><?php print gen_page_arrows_num($total_page,$page_on,"list.php") ?></div>
                    </form>
                </td>
                <td id="show_less"><span class="showless"></span></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th class="<?php print $visibility;?>">表紙</th>
                <th>タイトル</th>
                <th><button form="form" name="sort" value="<?php print "巻数,volume,"; print ($volume_sort == "" || $volume_sort == "arrow_drop_up")?"DESC,降順,down":"ASC,昇順,up";?>">巻数<span class="material-icons"><?php print $volume_sort;?></span></button></th>
                <th><button form="form" name="sort" value="<?php print "価格,price,"; print ($price_sort == "" || $price_sort == "arrow_drop_up")?"DESC,降順,down":"ASC,昇順,up";?>">価格<span class="material-icons"><?php print $price_sort;?></span></button></th>
                <th><button form="form" name="sort" value="<?php print "発売日,release_date,"; print ($release_date_sort == "" || $release_date_sort == "arrow_drop_up")?"DESC,降順,down":"ASC,昇順,up";?>">発売日<span class="material-icons"><?php print $release_date_sort;?></span></button></th>
                <th><button form="form" name="sort" value="<?php print "購入日,purchase_date,"; print ($purchase_date_sort == "" || $purchase_date_sort == "arrow_drop_up")?"DESC,降順,down":"ASC,昇順,up";?>">購入日<span class="material-icons"><?php print $purchase_date_sort;?></span></button></th>
            </tr>
            <?php foreach($page_books as $key => $row){?>
            <tr class="main_data">
                <td class="<?php print $visibility;?>"><div class="<?php print $has_image[$key][0];?>"><img src="<?php print $has_image[$key][1]; if($has_image[$key][1] !== "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==") print '?' . filemtime($has_image[$key][1]);?>" width="100px"></div></td>
                <td><?php print $row["title"];?></td>
                <td><?php print $row["volume"];?>巻</td>
                <td><?php print $row["price"];?>円</td>
                <td><?php print conv_date_jp($row["release_date"]);?></td>
                <td><?php if($row["purchase_date"] !== NULL) print conv_date_jp($row["purchase_date"]);?></td>
                <td class="dots">
                    <span class="horiz"></span>
                    <div>
                        <div class="edit_delete hidden">
                            <a href="./update.php?book=<?php print $row["id"];?>" class="edit"><p>編集する</p><span class="material-icons">edit</span></a>
                            <a href="./delete.php?book=<?php print $row["id"]; ?>" class="delete"><p>削除する</p><span class="material-icons">delete</span></a>
                        </div>
                    </div>
                </td>
            </tr>
            <?php }?>

            <tr id="no_result" class="<?php print $no_result;?>">
                <td>
                    <div>
                        表示できる項目がありません。検索条件を変更してみてください。
                    </div>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>
                    <div id="tfoot">
                        <div class="poal"><?php print $page_on;?> &frasl; <?php print $total_page;?>ページ</div>
                        <div class="arrows"><?php print gen_page_arrows_num($total_page,$page_on,"list.php") ?></div>
                    </div>
                    <div id="bottom_btn">
                        <button form="form" id="add_data_button" name="add_data"><span class="material-icons">playlist_add</span>単行本を登録する</button>
                        <button form="form" id="download_csv" name="download_csv" value="download"><span class="material-icons">download</span><div class="download_info">テーブルの情報を.csv形式でダウンロード</div></button>
                    </div>
                </td>
            </tr>
        </tfoot>
        </table>
    </setion>
    <a href="#" id="scroll_up"><span class="material-icons">arrow_upward</span></a>
    <!-- <button id="session" form="form" name="session" value="del">delete session</button> -->
<script src="js/script.js"></script>
</body>
</html>