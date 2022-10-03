<?php

/**
 * 移除選單 & 改名
 */
add_filter('woocommerce_account_menu_items', 'mua_remove_my_account_links');
function mua_remove_my_account_links($menu_links)
{
    // echo '<pre>';
    // var_dump($menu_links);
    // echo '</pre>';
    unset($menu_links['dashboard']);
    unset($menu_links['orders']);
    unset($menu_links['downloads']);
    unset($menu_links['edit-address']);
    unset($menu_links['payment-methods']);
    $menu_links['edit-account'] = '修改會員資料';
    //unset( $menu_links['edit-account'] );
    //unset( $menu_links[ 'dashboard' ] ); // Remove Dashboard
    //unset( $menu_links[ 'customer-logout' ] ); // Remove Logout link
    return $menu_links;
}





/**
 * @snippet       自訂 my account
 * @see           https://rudrastyh.com/woocommerce/my-account-menu.html#add-custom-tab
 */
add_filter('woocommerce_account_menu_items', 'mua_log_history_link', 40);
function mua_log_history_link($menu_links)
{
    $menu_added = array(
        'edit-vendor' => '編輯商店資料',
        'goto-vendor-shop' => '前往商店',
        'upload-portfolio' => '上載作品',
        'modify-portfolio' => '修改作品',
        'apply-jobs' => '申請/刊登工作'
    );
    $user = wp_get_current_user();
    if (!is_user_wcmp_vendor($user)) {
        unset($menu_added['edit-vendor']);
        unset($menu_added['goto-vendor-shop']);
    }

    $menu_links = array_slice($menu_links, 0, 5, true)
        + $menu_added + array_slice($menu_links, 5, NULL, true);

    return $menu_links;
}
// register permalink endpoint
add_action('init', 'mua_add_endpoint');
function mua_add_endpoint()
{

    add_rewrite_endpoint('upload-portfolio', EP_PAGES);
    add_rewrite_endpoint('modify-portfolio', EP_PAGES);
    add_rewrite_endpoint('apply-jobs', EP_PAGES);
    add_rewrite_endpoint('edit-vendor', EP_PAGES);
    add_rewrite_endpoint('goto-vendor-shop', EP_PAGES);
}
// content for the new page in My Account, woocommerce_account_{ENDPOINT NAME}_endpoint
add_action('woocommerce_account_upload-portfolio_endpoint', 'mua_my_account_uploadportfolio_endpoint_content');
function mua_my_account_uploadportfolio_endpoint_content()
{
    wp_redirect('https://search.mua.com.hk/add-new-album/');
    die;
}
add_action('woocommerce_account_modify-portfolio_endpoint', 'mua_my_account_modifyportfolio_endpoint_content');
function mua_my_account_modifyportfolio_endpoint_content()
{
    wp_redirect('https://search.mua.com.hk/edit-product-dashboard/');
    die;
}
add_action('woocommerce_account_apply-jobs_endpoint', 'mua_my_account_applyjobs_endpoint_content');
function mua_my_account_applyjobs_endpoint_content()
{
    wp_redirect('https://search.mua.com.hk/career-board/');
    die;
}

add_action('woocommerce_account_edit-vendor_endpoint', 'mua_my_account_editvendor_endpoint_content');
function mua_my_account_editvendor_endpoint_content()
{
    wc_get_template('myaccount/form-edit-vendor.php', array('vendor_id' => get_current_user_id()));
}

add_action('woocommerce_account_goto-vendor-shop_endpoint', 'mua_my_account_gotoVendorShop_endpoint_content');
function mua_my_account_gotoVendorShop_endpoint_content()
{

    $user = wp_get_current_user();
    $vendor = get_wcmp_vendor($user->ID);
    if (is_user_wcmp_vendor($user)) {
        wp_redirect($vendor->permalink);
        die;
    }
}

//移除 last name
add_filter('woocommerce_save_account_details_required_fields', 'ts_hide_last_name');
function ts_hide_last_name($required_fields)
{
  unset($required_fields["account_last_name"]);
  return $required_fields;
}


/**
 * 編輯帳號，頁面新增欄位
 */
