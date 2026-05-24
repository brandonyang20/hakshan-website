<?php
defined('ABSPATH') || exit;

/* ============================================================
   THEME SETUP
   ============================================================ */
function hakshan_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
    add_theme_support('responsive-embeds');

    add_image_size('outlet-card', 760, 570, true);
    add_image_size('outlet-hero', 1080, 810, true);
    add_image_size('dish-card', 560, 560, true);
    add_image_size('dish-hero', 800, 600, true);
    add_image_size('portrait', 600, 800, true);
    add_image_size('gallery-wide', 1200, 900, true);
    add_image_size('story-figure', 1200, 675, true);

    register_nav_menus(['primary' => __('Primary Navigation', 'hakshan')]);
}
add_action('after_setup_theme', 'hakshan_setup');

/* ============================================================
   SCRIPTS & STYLES
   ============================================================ */
function hakshan_scripts() {
    $ver = wp_get_theme()->get('Version');
    $uri = get_template_directory_uri();

    // Google Fonts (Noto Serif SC for Chinese; JetBrains Mono for labels)
    wp_enqueue_style(
        'hakshan-gfonts',
        'https://fonts.googleapis.com/css2?family=Noto+Serif+SC:wght@400;500;700&family=JetBrains+Mono:wght@400&display=swap',
        [], null
    );

    wp_enqueue_style('hakshan-styles', $uri . '/assets/css/styles.css', ['hakshan-gfonts'], $ver);
    wp_enqueue_style('hakshan-inner',  $uri . '/assets/css/inner.css',  ['hakshan-styles'],   $ver);

    wp_enqueue_script('hakshan-shell', $uri . '/assets/js/shell.js', [], $ver, true);
    wp_enqueue_script('hakshan-site',  $uri . '/assets/js/site.js',  ['hakshan-shell'], $ver, true);

    wp_localize_script('hakshan-site', 'HakshanData', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('hakshan_reservation'),
    ]);
}
add_action('wp_enqueue_scripts', 'hakshan_scripts');

/* preload brand fonts for LCP */
function hakshan_preload_fonts() {
    $uri = get_template_directory_uri();
    $fonts = [
        'Brother-1816-Regular.woff2',
        'Brother-1816-Printed-Regular.woff2',
    ];
    foreach ($fonts as $f) {
        printf(
            '<link rel="preload" href="%s/assets/fonts/%s" as="font" type="font/woff2" crossorigin>',
            esc_url($uri), esc_attr($f)
        );
        echo "\n";
    }
    // Google Fonts preconnect
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action('wp_head', 'hakshan_preload_fonts', 1);

/* ============================================================
   CUSTOM POST TYPES
   ============================================================ */
function hakshan_register_cpts() {

    // Menu Item
    register_post_type('menu_item', [
        'labels' => [
            'name'               => __('Menu Items', 'hakshan'),
            'singular_name'      => __('Menu Item', 'hakshan'),
            'add_new_item'       => __('Add New Dish', 'hakshan'),
            'edit_item'          => __('Edit Dish', 'hakshan'),
            'all_items'          => __('All Dishes', 'hakshan'),
        ],
        'public'             => true,
        'show_in_rest'       => true,
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-food',
        'supports'           => ['title', 'editor', 'thumbnail', 'page-attributes', 'custom-fields'],
        'show_in_nav_menus'  => false,
        'rewrite'            => ['slug' => 'dish'],
    ]);

    // Outlet
    register_post_type('outlet', [
        'labels' => [
            'name'               => __('Outlets', 'hakshan'),
            'singular_name'      => __('Outlet', 'hakshan'),
            'add_new_item'       => __('Add New Outlet', 'hakshan'),
            'edit_item'          => __('Edit Outlet', 'hakshan'),
            'all_items'          => __('All Outlets', 'hakshan'),
        ],
        'public'             => true,
        'show_in_rest'       => true,
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-location-alt',
        'supports'           => ['title', 'thumbnail', 'page-attributes', 'custom-fields'],
        'show_in_nav_menus'  => false,
        'rewrite'            => ['slug' => 'outlet'],
    ]);
}
add_action('init', 'hakshan_register_cpts');

/* Dish category taxonomy */
function hakshan_register_taxonomies() {
    register_taxonomy('dish_category', 'menu_item', [
        'label'        => __('Dish Category', 'hakshan'),
        'labels'       => [
            'name'              => __('Dish Categories', 'hakshan'),
            'singular_name'     => __('Dish Category', 'hakshan'),
            'add_new_item'      => __('Add New Category', 'hakshan'),
        ],
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'dish-category'],
    ]);
}
add_action('init', 'hakshan_register_taxonomies');

/* ============================================================
   META BOXES — MENU ITEM
   ============================================================ */
function hakshan_menu_item_meta_box($post) {
    wp_nonce_field('hakshan_menu_item_meta', 'hakshan_menu_item_nonce');
    $zh_name = get_post_meta($post->ID, '_hakshan_zh_name', true);
    $zh_desc = get_post_meta($post->ID, '_hakshan_zh_description', true);
    ?>
    <table class="form-table">
      <tr>
        <th><label for="hakshan_zh_name">Chinese Name (中文名)</label></th>
        <td><input type="text" id="hakshan_zh_name" name="hakshan_zh_name"
                   value="<?php echo esc_attr($zh_name); ?>" class="regular-text" /></td>
      </tr>
      <tr>
        <th><label for="hakshan_zh_description">Chinese Description (中文介绍)</label></th>
        <td><textarea id="hakshan_zh_description" name="hakshan_zh_description"
                      rows="3" class="large-text"><?php echo esc_textarea($zh_desc); ?></textarea></td>
      </tr>
    </table>
    <p class="description">English name = post title. English description = post excerpt (or first paragraph of content).</p>
    <?php
}

function hakshan_register_menu_item_meta_box() {
    add_meta_box('hakshan_menu_item', 'Bilingual Content', 'hakshan_menu_item_meta_box', 'menu_item', 'normal', 'high');
}
add_action('add_meta_boxes', 'hakshan_register_menu_item_meta_box');

function hakshan_save_menu_item_meta($post_id) {
    if (!isset($_POST['hakshan_menu_item_nonce']) || !wp_verify_nonce($_POST['hakshan_menu_item_nonce'], 'hakshan_menu_item_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['hakshan_zh_name']))
        update_post_meta($post_id, '_hakshan_zh_name', sanitize_text_field($_POST['hakshan_zh_name']));
    if (isset($_POST['hakshan_zh_description']))
        update_post_meta($post_id, '_hakshan_zh_description', sanitize_textarea_field($_POST['hakshan_zh_description']));
}
add_action('save_post_menu_item', 'hakshan_save_menu_item_meta');

/* ============================================================
   META BOXES — OUTLET
   ============================================================ */
function hakshan_outlet_meta_box($post) {
    wp_nonce_field('hakshan_outlet_meta', 'hakshan_outlet_nonce');
    $fields = [
        '_hakshan_cn_name'  => ['label' => 'Chinese Name (中文名)', 'type' => 'text'],
        '_hakshan_city'     => ['label' => 'City', 'type' => 'text', 'placeholder' => 'Subang Jaya'],
        '_hakshan_address'  => ['label' => 'Full Address', 'type' => 'textarea'],
        '_hakshan_hours'    => ['label' => 'Hours', 'type' => 'text', 'placeholder' => 'Daily 11:00 — 22:00'],
        '_hakshan_seats'    => ['label' => 'Seats', 'type' => 'text', 'placeholder' => '120 + private 24 · Charity table'],
        '_hakshan_phone'    => ['label' => 'Phone', 'type' => 'text', 'placeholder' => '+60 16-246 2970'],
        '_hakshan_maps_url' => ['label' => 'Google Maps URL', 'type' => 'url'],
    ];
    echo '<table class="form-table">';
    foreach ($fields as $key => $field) {
        $val = get_post_meta($post->ID, $key, true);
        $id = ltrim($key, '_');
        echo '<tr><th><label for="' . esc_attr($id) . '">' . esc_html($field['label']) . '</label></th><td>';
        if ($field['type'] === 'textarea') {
            echo '<textarea id="' . esc_attr($id) . '" name="' . esc_attr($id) . '" rows="2" class="large-text">' . esc_textarea($val) . '</textarea>';
        } else {
            $ph = isset($field['placeholder']) ? ' placeholder="' . esc_attr($field['placeholder']) . '"' : '';
            echo '<input type="' . esc_attr($field['type']) . '" id="' . esc_attr($id) . '" name="' . esc_attr($id) . '" value="' . esc_attr($val) . '" class="regular-text"' . $ph . ' />';
        }
        echo '</td></tr>';
    }
    echo '</table>';
    echo '<p class="description">Outlet name = post title. Featured image = card + modal photo. Post slug = the hash used in URL (e.g. "usj" → /outlets#usj). Set via "Permalink" in editor.</p>';
}

function hakshan_register_outlet_meta_box() {
    add_meta_box('hakshan_outlet', 'Outlet Details', 'hakshan_outlet_meta_box', 'outlet', 'normal', 'high');
}
add_action('add_meta_boxes', 'hakshan_register_outlet_meta_box');

function hakshan_save_outlet_meta($post_id) {
    if (!isset($_POST['hakshan_outlet_nonce']) || !wp_verify_nonce($_POST['hakshan_outlet_nonce'], 'hakshan_outlet_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $text_fields = ['_hakshan_cn_name','_hakshan_city','_hakshan_hours','_hakshan_seats','_hakshan_phone'];
    $meta_map = [
        '_hakshan_cn_name'  => 'hakshan_cn_name',
        '_hakshan_city'     => 'hakshan_city',
        '_hakshan_hours'    => 'hakshan_hours',
        '_hakshan_seats'    => 'hakshan_seats',
        '_hakshan_phone'    => 'hakshan_phone',
        '_hakshan_address'  => 'hakshan_address',
        '_hakshan_maps_url' => 'hakshan_maps_url',
    ];
    foreach ($meta_map as $meta_key => $post_key) {
        if (!isset($_POST[$post_key])) continue;
        if ($meta_key === '_hakshan_address')
            update_post_meta($post_id, $meta_key, sanitize_textarea_field($_POST[$post_key]));
        elseif ($meta_key === '_hakshan_maps_url')
            update_post_meta($post_id, $meta_key, esc_url_raw($_POST[$post_key]));
        else
            update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$post_key]));
    }
}
add_action('save_post_outlet', 'hakshan_save_outlet_meta');

/* ============================================================
   RESERVATION FORM — AJAX HANDLER
   ============================================================ */
function hakshan_handle_reservation() {
    check_ajax_referer('hakshan_reservation', 'nonce');

    $outlet   = sanitize_text_field($_POST['outlet']   ?? '');
    $date     = sanitize_text_field($_POST['date']     ?? '');
    $time     = sanitize_text_field($_POST['time']     ?? '');
    $party    = absint($_POST['party']                 ?? 0);
    $name     = sanitize_text_field($_POST['name']     ?? '');
    $phone    = sanitize_text_field($_POST['phone']    ?? '');
    $email    = sanitize_email($_POST['email']         ?? '');
    $notes    = sanitize_textarea_field($_POST['notes']    ?? '');
    $occasion = sanitize_text_field($_POST['occasion'] ?? '');

    if (!$name || !$phone || !$outlet) {
        wp_send_json_error(['message' => 'Please fill in outlet, name, and phone number.']);
        return;
    }

    $to      = get_option('hakshan_reservation_email', get_option('admin_email'));
    $subject = "[Hakshan Reservation] {$outlet} · {$date} {$time} · {$party} pax";
    $body    = implode("\n", [
        "Outlet:   {$outlet}",
        "Date:     {$date}",
        "Time:     {$time}",
        "Party:    {$party} pax",
        "Occasion: {$occasion}",
        "---",
        "Name:     {$name}",
        "Phone:    {$phone}",
        "Email:    {$email}",
        "---",
        "Notes:\n{$notes}",
        "",
        "Submitted: " . current_time('d M Y H:i'),
    ]);

    $headers = ['Content-Type: text/plain; charset=UTF-8'];
    if ($email) $headers[] = "Reply-To: {$name} <{$email}>";

    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent && $email) {
        wp_mail(
            $email,
            'Your reservation at Hakshan — we\'ll confirm shortly',
            "Dear {$name},\n\nThank you for your reservation request.\n\nOutlet: {$outlet}\nDate: {$date}\nTime: {$time}\nParty: {$party} pax\n\nWe will confirm by phone within one hour.\n\nHakshan 客善\n+60 16-246 2970 · hello@hakshan.com",
            ['Content-Type: text/plain; charset=UTF-8']
        );
    }

    if ($sent) {
        wp_send_json_success(['message' => 'Reservation received — we\'ll confirm by phone within one hour.']);
    } else {
        wp_send_json_error(['message' => 'Submission failed. Please call +60 16-246 2970 or WhatsApp us directly.']);
    }
}
add_action('wp_ajax_hakshan_reservation', 'hakshan_handle_reservation');
add_action('wp_ajax_nopriv_hakshan_reservation', 'hakshan_handle_reservation');

/* ============================================================
   SETTINGS PAGE — ADMIN EMAIL + SEO DEFAULTS
   ============================================================ */
function hakshan_settings_page() {
    add_options_page('Hakshan Settings', 'Hakshan', 'manage_options', 'hakshan-settings', 'hakshan_settings_render');
}
add_action('admin_menu', 'hakshan_settings_page');

function hakshan_settings_render() {
    if (!current_user_can('manage_options')) return;
    if (isset($_POST['hakshan_save_settings']) && wp_verify_nonce($_POST['_wpnonce'], 'hakshan_settings')) {
        update_option('hakshan_reservation_email', sanitize_email($_POST['reservation_email']));
        echo '<div class="notice notice-success"><p>Settings saved.</p></div>';
    }
    $email = get_option('hakshan_reservation_email', get_option('admin_email'));
    ?>
    <div class="wrap">
        <h1>Hakshan Settings</h1>
        <form method="post">
            <?php wp_nonce_field('hakshan_settings'); ?>
            <table class="form-table">
                <tr>
                    <th><label for="reservation_email">Reservation Notification Email</label></th>
                    <td>
                        <input type="email" id="reservation_email" name="reservation_email"
                               value="<?php echo esc_attr($email); ?>" class="regular-text" />
                        <p class="description">Reservation form submissions will be sent here.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button('Save Settings', 'primary', 'hakshan_save_settings'); ?>
        </form>
    </div>
    <?php
}

/* ============================================================
   HELPERS
   ============================================================ */

/** Return outlet data array for a given outlet post ID */
function hakshan_outlet_data(int $post_id): array {
    return [
        'name'   => get_the_title($post_id),
        'cn'     => (string) get_post_meta($post_id, '_hakshan_cn_name', true),
        'city'   => strtoupper((string) get_post_meta($post_id, '_hakshan_city', true)),
        'addr'   => (string) get_post_meta($post_id, '_hakshan_address', true),
        'hours'  => (string) get_post_meta($post_id, '_hakshan_hours', true),
        'seats'  => (string) get_post_meta($post_id, '_hakshan_seats', true),
        'phone'  => (string) get_post_meta($post_id, '_hakshan_phone', true),
        'maps'   => (string) get_post_meta($post_id, '_hakshan_maps_url', true),
        'photo'  => has_post_thumbnail($post_id) ? get_the_post_thumbnail_url($post_id, 'outlet-hero') : '',
        'photo_card' => has_post_thumbnail($post_id) ? get_the_post_thumbnail_url($post_id, 'outlet-card') : '',
    ];
}

/** Return dish category configuration */
function hakshan_dish_categories(): array {
    return [
        'signatures'   => ['en' => 'Signatures',       'zh' => '招牌菜',  'ch' => '招 牌', 'desc_en' => "Six dishes the kitchen will never take off the menu. Ah Por's six.", 'desc_zh' => '六道我们永远不会下架的菜 — 阿婆留下的六道。'],
        'salt-smoke'   => ['en' => 'Salt & Smoke',     'zh' => '盐与烟',  'ch' => '盐 与 烟', 'desc_en' => 'What the Hakka did when there was no fridge.', 'desc_zh' => '客家人在没有冰箱年代留下来的味道。'],
        'braised'      => ['en' => 'Braised & Stewed', 'zh' => '焖与炖',  'ch' => '焖 与 炖', 'desc_en' => 'Dishes that benefit from being made the day before.', 'desc_zh' => '过夜更入味的那一类。'],
        'yong-tau-foo' => ['en' => 'Yong Tau Foo',     'zh' => '酿豆腐',  'ch' => '酿 豆 腐', 'desc_en' => 'Fish paste pounded by hand at 6am. Stuffed by 10am. Sold out by 9pm.', 'desc_zh' => '清晨六点手工捶打鱼浆，十点酿好，晚上九点前卖完。'],
        'rice-noodles' => ['en' => 'Rice & Noodles',   'zh' => '饭与面',  'ch' => '饭 与 面', 'desc_en' => 'Wheat for cold days, rice for everything else.', 'desc_zh' => '冷天吃麦，其他时候吃饭。'],
        'soups-wines'  => ['en' => 'Soups & Wines',    'zh' => '汤与酒',  'ch' => '汤 与 酒', 'desc_en' => "Hakka women drank rice wine against the cold. Hakka men drank it too — just less honestly.", 'desc_zh' => '客家妇女用米酒驱寒，客家男人也喝 — 只是没那么坦白。'],
        'sweet'        => ['en' => 'Sweet',             'zh' => '甜品',    'ch' => '甜 品', 'desc_en' => 'Three options. Two of them are warm.', 'desc_zh' => '三种甜，其中两种是热的。'],
    ];
}

/** Photo placeholder div */
function hakshan_ph(string $label, string $extra_class = ''): string {
    $cls = trim('ph ' . $extra_class);
    return '<div class="' . esc_attr($cls) . '" data-label="' . esc_attr($label) . '"></div>';
}
