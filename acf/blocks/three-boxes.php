<?php
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$section_id = get_field('section_id');
$background = get_field('background');
$boxes = get_field('boxes');

$panelpvCurrentUser = wp_get_current_user();
$panelpvUserRoles = is_user_logged_in() && is_array($panelpvCurrentUser->roles) ? $panelpvCurrentUser->roles : array();
$panelpvIsRoleZwyczajny = in_array('czlonek_zwyczajny', $panelpvUserRoles, true);
$panelpvIsRoleWspierajacy = in_array('czlonek_wspierajacy', $panelpvUserRoles, true);
$panelpvIsMemberLogged = $panelpvIsRoleZwyczajny || $panelpvIsRoleWspierajacy;
?>

<?php if (!empty($boxes)): ?>
<div class="three-boxes <?php if ($background == 'true') { echo 'three-boxes--background'; } ?>">
  <?php if (!empty($section_id)): ?>
  <div class="section-id" id="<?php echo esc_html($section_id); ?>"></div>
  <?php endif; ?>
  <div class="container">
    <div class="three-boxes__wrapper">
      <div class="row">
        <?php foreach ($boxes as $key => $item): ?>
        <?php
        $panelpvItemMember = !empty($item['member']) ? sanitize_title($item['member']) : '';
        $panelpvItemClasses = 'three-boxes__item';
        if (!empty($panelpvItemMember)) {
            $panelpvItemClasses = $panelpvItemClasses . ' three-boxes__item--' . $panelpvItemMember;
        }
        if ($panelpvIsMemberLogged) {
            $panelpvShouldBeInactive = false;
            if ($panelpvIsRoleZwyczajny && $panelpvItemMember !== 'czlonek_zwyczajny') {
                $panelpvShouldBeInactive = true;
            }
            if ($panelpvIsRoleWspierajacy && $panelpvItemMember !== 'czlonek_wspierajacy') {
                $panelpvShouldBeInactive = true;
            }
            if ($panelpvShouldBeInactive) {
                $panelpvItemClasses = $panelpvItemClasses . ' three-boxes__item--inactive';
            }
        }
        $panelpvLinkTitleToShow = '';
        if (!empty($item['link']['title'])) {
            $panelpvLinkTitleToShow = $item['link']['title'];
        }
        if ($panelpvIsMemberLogged) {
            $panelpvLinkTitleToShow = 'Zobacz materiały';
        }
        $panelpvLinkUrlToShow = '';
        if (!empty($item['link']['url'])) {
            $panelpvLinkUrlToShow = $item['link']['url'];
        }
        if ($panelpvIsRoleZwyczajny) {
            $panelpvLinkUrlToShow = home_url('/czlonkostwo-zwyczajne/');
        }
        if ($panelpvIsRoleWspierajacy) {
            $panelpvLinkUrlToShow = home_url('/czlonkostwo-wspierajace/');
        }
        ?>
        <div class="col-sm-6">
          <div class="<?php echo esc_attr($panelpvItemClasses); ?>">
            <div>
              <?php if (!empty($item['icon'])): ?>
              <div class="three-boxes__icon">
                <?php echo wp_get_attachment_image($item['icon'], 'full', '', array('class' => '')); ?>
              </div>
              <?php endif; ?>
              <?php if (!empty($item['content'])): ?>
              <div class="three-boxes__content"><?php echo apply_filters('the_title', $item['content']); ?></div>
              <?php endif; ?>
            </div>
            <?php if (!empty($panelpvLinkUrlToShow)): ?>
            <a href="<?php echo esc_url($panelpvLinkUrlToShow); ?>" class="button button--small three-boxes__button"><?php echo esc_html($panelpvLinkTitleToShow); ?></a>
            <?php endif; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
