<!-- ログインモーダル -->
<div id="add_schedule_modal_wrapper" class="modal_wrapper <?php echo $add_schedule_modal ?>">
    <form id="add_schedule_modal" class="f_box modal_box" method="post">
    <h2>新規スケジュール</h2>
        <?php //閉じる用のアイコンボタン  ?>
        <span class="material-icons-outlined modal_close" id="add_schedule_modal_close">cancel</span>
            <!--入力欄：タイトル-->
            <div class="f_container_opt">
                <div class="f_title_parts">
                    <p class="f_title">タイトル</p>
                </div>
                <div class="f_input_parts">
                    <input class="f_input" type="text" name="title" value="">
                </div>
                <div class="f_discription_parts">
                    <p class="f_error"><?php echo isset($error['title']) ? $error['title'] : ''; ?></p>
                </div>
            </div>
            <!--入力欄：スケジュールの説明-->
            <div class="f_container_opt">
                <div class="f_title_parts">
                    <p class="f_title">スケジュールの説明</p>
                </div>
                <div class="f_input_parts">
                    <textarea class="f_input" name="explanation" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="f_discription_parts">
                    <p class="f_error"></p>
                </div>
            </div>
            <div class="hr"></div>
            <!--入力欄：開始時間の選択-->
            <div class="f_container_opt">
                <div class="f_title_parts">
                    <p class="f_title">開始時間の選択</p>
                </div>
                <div class="f_input_parts">
                    <input class="f_input" type="time" name="start" value="">
                </div>
                <div class="f_discription_parts">
                    <p class="f_error"><?php echo isset($error['start']) ? $error['start'] : ''; ?></p>
                </div>
            </div>
            <!--入力欄：終了時間の選択-->
            <div class="f_container_opt">
                <div class="f_title_parts">
                    <p class="f_title">終了時間の選択</p>
                </div>
                <div class="f_input_parts">
                    <input class="f_input" type="time" name="end" value="">
                </div>
                <div class="f_discription_parts">
                    <p class="f_error"><?php echo isset($error['end']) ? $error['end'] : ''; ?></p>
                </div>
            </div>
            <div class="hr"></div>
            <!--入力欄：繰り返し-->
            <div class="f_container_opt">
                <div class="f_title_parts">
                    <p class="f_title">繰り返しの単位</p>
                </div>
                <div class="f_input_parts">
                    <select class="f_input" name="repeat_every" id="repeat_every">
                        <option value="no" selected>しない</option>
                        <option value="days">毎日</option>
                        <option value="weeks">毎週</option>
                        <option value="months">毎月</option>
                        <option value="years">毎年</option>
                    </select>
                </div>
                <div class="f_discription_parts">
                    <p class="f_error"></p>
                </div>
            </div>
            <!--入力欄：繰り返し-->
            <div class="f_container_opt hidden repeat">
                <div class="f_title_parts">
                    <p class="f_title">繰り返しの頻度</p>
                </div>
                <div class="f_input_parts">
                    <select class="f_input" name="repeat_frequency" id="repeat_frequency">
                    </select>
                </div>
                <div class="f_discription_parts">
                    <p class="f_error"></p>
                </div>
            </div>
            <!--入力欄：終了日時の設定-->
            <div class="f_container_opt hidden repeat">
                <div class="f_title_parts">
                    <p class="f_title">繰り返しの終了日</p>
                </div>
                <div class="f_input_parts">
                    <input class="f_input" type="date" name="end_repeat" value="">
                </div>
                <div class="f_discription_parts">
                    <p class="f_error"><?php echo isset($error['end_repeat']) ? $error['end_repeat'] : ''; ?></p>
                </div>
            </div>
            <div class="hr"></div>
            <!--入力欄：終了日時の設定-->
            <div class="f_container_opt">
                <div class="f_title_parts">
                    <p class="f_title">スケジュールカテゴリ</p>
                </div>
                <div class="f_input_parts">
                    <input class="f_input" type="text" name="category" value="" list="schedule_category">
                    <datalist id="schedule_category">
                        <?php
                        foreach($schedule_category_list as $val){?>
                            <option value="<?php print $val["category"]?>"></option><?php
                        }
                        ?>
                    </datalist>
                </div>
                <div class="f_discription_parts">
                </div>
            </div>
            <div class="submit_box"><button class="btn btn-green" name="button" value="add_schedule">スケジュールを追加する</button></div>
    </form>
</div>