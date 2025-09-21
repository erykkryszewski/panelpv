<?php
get_header();
global $post, $wp_query;

// bieżąca strona dla paginacji
$current_blog_page = get_query_var('paged') ? (int) get_query_var('paged') : 1;

// tytuł archiwum w tej samej logice co wcześniej
$archive_title = get_the_archive_title();
$title_parts = explode(':', $archive_title);
$page_title = wp_strip_all_tags(end($title_parts));
?>
<main id="main" class="main <?php if (!is_front_page()) {
  echo 'main--subpage';
} ?>">
  <div class="subpage-hero">
    <div class="subpage-hero__background subpage-hero__background--plain"></div>
    <div class="container">
      <div class="subpage-hero__wrapper">
        <h1 class="subpage-hero__title"><?php echo apply_filters('the_title', $page_title); ?></h1>
      </div>
    </div>
  </div>

  <div class="spacer" style="height: 75px"></div>

  <div class="section-title">
    <div class="container">
      <div class="section-title__wrapper section-title__wrapper--decorated">
        <?php if (is_category('strefa-wiedzy') || has_term('strefa-wiedzy', 'category')): ?>
        <h2 class="section-title__title section-title__title--left"><span>Baza wiedzy</span>Analizy i opracowania
          ekspertów</h2>
        <p>Znajdziesz tu raporty, prognozy i komentarze tworzone przez specjalistów PSF – źródło sprawdzonych informacji
          o rynku PV i transformacji energetycznej.</p>
        <?php elseif (is_category('aktualnosci') || has_term('aktualnosci', 'category')): ?>
        <h2 class="section-title__title section-title__title--left"><span>Na bieżąco</span>Aktualności z branży PV</h2>
        <p>Najważniejsze informacje o regulacjach, działaniach PSF i trendach rynkowych – śledź zmiany, które wpływają
          na przyszłość fotowoltaiki.</p>
        <?php elseif (is_category('video') || has_term('video', 'category')): ?>
        <h2 class="section-title__title section-title__title--left"><span>Multimedia</span>Strefa Video
        </h2>
        <p>Wywiady, relacje i nagrania z wydarzeń – zobacz, jak PSF kształtuje przyszłość fotowoltaiki w Polsce i
          Europie.</p>
        <?php else: ?>
        <h2 class="section-title__title section-title__title--left"><span>PSF</span>Informacje ze świata fotowoltaiki
        </h2>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="spacer" style="height: 50px"></div>

  <?php if (have_posts()): ?>
  <div class="theme-blog">
    <div class="container">
      <div class="theme-blog__wrapper">
        <div class="row">
          <?php while (have_posts()):

            the_post();

            $terms = get_the_terms(get_the_ID(), 'category') ?: [];
            $mods = array_map(fn($t) => 'theme-blog__item--' . sanitize_html_class($t->slug), $terms);
            $theme_blog_item = 'theme-blog__item' . (!empty($mods) ? ' ' . implode(' ', $mods) : '');

            $is_video = false;
            if (!empty($terms)) {
              foreach ($terms as $term) {
                if ($term->slug === 'video') {
                  $is_video = true;
                  break;
                }
              }
            }
            ?>
          <div class="col-12 col-md-6 col-lg-4 theme-blog__column">
            <div class="<?php echo esc_attr($theme_blog_item); ?>">
              <div class="theme-blog__image <?php echo $is_video ? 'theme-blog__image--video' : ''; ?>">
                <a href="<?php the_permalink(); ?>" class="cover"></a>
                <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'full', false, [
                  'class' => 'object-fit-cover',
                  'loading' => 'lazy',
                  'decoding' => 'async',
                ]); ?>
              </div>
              <div class="theme-blog__content">
                <div>
                  <a href="<?php the_permalink(); ?>" class="theme-blog__title"><?php the_title(); ?></a>
                  <p class="small">
                    <?php
                    $excerpt = get_the_excerpt();
                    if (empty($excerpt)) {
                      $content = get_the_content();
                      echo esc_html(wp_trim_words(wp_strip_all_tags($content), 15, '…'));
                    } else {
                      echo esc_html(wp_trim_words($excerpt, 15, '…'));
                    }
                    ?>
                  </p>
                </div>
                <a href="<?php the_permalink(); ?>" class="theme-blog__button">
                  <?php if ($is_video) {
                    _e('Zobacz video', 'ercodingtheme');
                  } else {
                    _e('Czytaj więcej', 'ercodingtheme');
                  } ?>
                </a>
              </div>
            </div>
          </div>
          <?php
          endwhile; ?>
        </div>
      </div>

      <div class="pagination mt-5">
        <?php echo paginate_links([
          'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
          'current' => max(1, $current_blog_page),
          'format' => '?paged=%#%',
          'total' => (int) $wp_query->max_num_pages,
          'show_all' => false,
          'type' => 'list',
          'end_size' => 2,
          'mid_size' => 1,
          'prev_next' => true,
          'prev_text' => '',
          'next_text' => '',
          'add_args' => false,
          'add_fragment' => '',
        ]); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
