//load in admin
//wcmp_page_vendors

/**
 * Field
 * 1. 職稱
 * 2. 入行年份
 * 3. 服務收費
 * 4. 其他詳情
 */


// 要改寫成跟後端要資料，不然會取到舊資料

(function ($) {
    let checkFieldExist = setInterval(function () {
        if ($(".find_address_wrapper").length) {
            //console.log("Field Exist");
            let html = "";

            //畢業學校
            html += `
            <fieldset class="vendor_school_wrapper">
                <p class="vendor_school"><strong>畢業學校</strong></p>

                <label class="screen-reader-text" for="vendor_school">職稱</label>
                <label class="hint-container"></label>
                <input type="text" id="vendor_school" name="vendor_school" class="regular-text" value="${ajax_object.vendor._vendor_school[0]}" placeholder="">
            </fieldset>
            `;

            //職稱
            html += `
            <fieldset class="vendor_jobtitle_wrapper">
                <p class="vendor_jobtitle"><strong>職稱</strong></p>

                <label class="screen-reader-text" for="vendor_jobtitle">職稱</label>
                <label class="hint-container"></label>
                <input type="text" id="vendor_jobtitle" name="vendor_jobtitle" class="regular-text" value="${ajax_object.vendor._vendor_jobtitle[0]}" placeholder="">
            </fieldset>
            `;
            //入行年份
            html += `
            <fieldset class="vendor_exp_wrapper">
                <p class="vendor_exp"><strong>入行年份</strong></p>

                <label class="screen-reader-text" for="vendor_exp">入行年份</label>
                <label class="hint-container"></label>
                <input type="text" id="vendor_exp" name="vendor_exp" class="regular-text" value="${ajax_object.vendor._vendor_exp[0]}" placeholder="">
            </fieldset>
            `;
            //服務收費
            html += `
            <fieldset class="vendor_charge_wrapper">
                <p class="vendor_charge" style="vertical-align: top;"><strong>服務收費</strong></p>

                <label class="screen-reader-text" for="vendor_charge">服務收費</label>
                ${ajax_object.vendor_charge_editor}
            </fieldset>
            `;


            //其他詳情
            html += `
            <fieldset class="vendor_other_wrapper">
                <p class="vendor_other" style="vertical-align: top;"><strong>其他詳情</strong></p>

                <label class="screen-reader-text" for="vendor_other">其他詳情</label>
                ${ajax_object.vendor_other_editor}
            </fieldset>
            `;

            $(".find_address_wrapper").after(html);
            setTimeout(() => {
                $('#vendor_other-tmce, #vendor_charge-tmce').click();
            }, 500);

            $('#wc-backbone-modal-dialog').before('<p id="update_status"></p>');


            //Update

            //隱藏舊按鈕
            $('button[name="wcmp_vendor_submit"]').hide();
            //先做顆假按鈕
            $("#wc-backbone-modal-dialog").append('<div id="yc_update_button" class="button button-primary vendor-update-btn wcmp-primary-btn">更新</div>');

            $('#yc_update_button').click(function () {
                //pass data to back end
                const vendor_id = $(".vendor-suspend-btn").attr("data-vendor-id");
                const vendor_jobtitle = $("#vendor_jobtitle").val();
                const vendor_exp = $("#vendor_exp").val();
                const vendor_charge = tinyMCE.get('vendor_charge').getContent();
                const vendor_other = tinyMCE.get('vendor_other').getContent();
                const vendor_school = $("#vendor_school").val();

                console.log('start')
                $.ajax({
                    type: "POST",
                    url: ajax_object._ajaxurl,
                    //dataType: "json",
                    data: {
                        action: "wcmp_custom_update",
                        vendor_id: vendor_id,
                        vendor_jobtitle: vendor_jobtitle,
                        vendor_exp: vendor_exp,
                        vendor_charge: vendor_charge,
                        vendor_other: vendor_other,
                        vendor_school: vendor_school
                    },
                    beforeSend: function () {
                            $('#update_status').text('更新中...請勿關閉視窗...');
                            console.log('before send')
                    },
                    success: function (data) {
                        // Handle the complete event
                        $('#update_status').text('✅ 已經成功更新資料 ✅');
                        $('button[name="wcmp_vendor_submit"]').click();
                        console.log('submited')
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown){
                        $('#update_status').text('⚠️ 更新資料失敗，請聯絡系統管理員 ⚠️');
                        console.log('更新失敗', XMLHttpRequest, textStatus, errorThrown)
                    }
                });
            });

        }
        clearInterval(checkFieldExist);
    }, 100); // check every 100ms
})(jQuery);
