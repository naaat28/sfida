<?php get_header(); ?>

<div class="l_container-lg">
  <div class="m_switching-box">
    <button type="button" aria-label="Home" id="home" class="m_switching-home">
      Home
    </button>
    <span class="m_switch-img_wrapper visitor">
      <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="m_switch-img">
        <path d="M11.3537 9.35378L9.35365 11.3538C9.25983 11.4476 9.13259 11.5003 8.9999 11.5003C8.86722 11.5003 8.73997 11.4476 8.64615 11.3538C8.55233 11.26 8.49963 11.1327 8.49963 11C8.49963 10.8674 8.55233 10.7401 8.64615 10.6463L9.79303 9.50003H0.999905C0.867297 9.50003 0.74012 9.44736 0.646352 9.35359C0.552584 9.25982 0.499905 9.13264 0.499905 9.00003C0.499905 8.86743 0.552584 8.74025 0.646352 8.64648C0.74012 8.55271 0.867297 8.50003 0.999905 8.50003H9.79303L8.64615 7.35378C8.55233 7.25996 8.49963 7.13272 8.49963 7.00003C8.49963 6.86735 8.55233 6.7401 8.64615 6.64628C8.73997 6.55246 8.86722 6.49976 8.9999 6.49976C9.13259 6.49976 9.25983 6.55246 9.35365 6.64628L11.3537 8.64628C11.4001 8.69272 11.437 8.74786 11.4622 8.80856C11.4873 8.86926 11.5003 8.93433 11.5003 9.00003C11.5003 9.06574 11.4873 9.1308 11.4622 9.1915C11.437 9.2522 11.4001 9.30735 11.3537 9.35378ZM2.64615 5.35378C2.73998 5.4476 2.86722 5.50031 2.99991 5.50031C3.13259 5.50031 3.25984 5.4476 3.35366 5.35378C3.44748 5.25996 3.50018 5.13272 3.50018 5.00003C3.50018 4.86735 3.44748 4.7401 3.35366 4.64628L2.20678 3.50003H10.9999C11.1325 3.50003 11.2597 3.44736 11.3535 3.35359C11.4472 3.25982 11.4999 3.13264 11.4999 3.00003C11.4999 2.86743 11.4472 2.74025 11.3535 2.64648C11.2597 2.55271 11.1325 2.50003 10.9999 2.50003H2.20678L3.35366 1.35378C3.44748 1.25996 3.50018 1.13272 3.50018 1.00003C3.50018 0.867352 3.44748 0.740104 3.35365 0.646284C3.25983 0.552464 3.13259 0.499756 2.99991 0.499756C2.86722 0.499756 2.73998 0.552464 2.64615 0.646284L0.646155 2.64628C0.599667 2.69272 0.562787 2.74786 0.537625 2.80856C0.512463 2.86926 0.499512 2.93433 0.499512 3.00003C0.499512 3.06574 0.512463 3.13081 0.537625 3.1915C0.562787 3.2522 0.599667 3.30735 0.646155 3.35378L2.64615 5.35378Z" fill="white" />
      </svg>
    </span>
    <button type="button" aria-label="Visitor" id="visitor" class="m_switching-visitor">
      Visitor
    </button>
  </div>

  <div class="m_contact-sp u_pc-hidden">
    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="m_contact-sp_link">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/src/img/mail.svg" alt="mail" width="36" height="29" class="m_contact-sp_img" />
    </a>
  </div>
  <!-- /.m_contact-sp u_pc-hidden -->
</div>

<main>
  <section class="m_section-top l_section" id="news">
    <div class="l_container-sm">
      <h1 class="m_section-title">News</h1>

      <div class="m_section-contents m_section_bar l_content">
        <div class="m_news-inner">

          <?php
          $paged = get_query_var('paged') ? get_query_var('paged') : 1;
          $posts_per_page = 5; //1ページの投稿数
          $data_count = 1;
          $list_args = array(
            'post_type'      => 'news', //カスタム投稿タイプ「news」
            'posts_per_page' => $posts_per_page,
            'post_status'    => 'publish',
            'paged'          => $paged,
            'orderby'        => 'post_date',
            'order'          => 'DESC'
          );
          $list_query = new WP_Query($list_args);
          if ($list_query->have_posts()) :
            while ($list_query->have_posts()) : $list_query->the_post();
          ?>

              <article class="m_article-list js_news-modalOpen" data-modal-target="modal<?php echo $data_count; ?>">
                <a href="#" class="m_article-link" data-modal-target="modal<?php echo $data_count; ?>">
                  <time class="m_article-item_date" datetime="<?php echo get_the_date('Y-m-d'); ?>">
                    <?php the_time('Y.m.d'); ?>
                  </time>
                  <h3 class="m_article-item_title">
                    <?php the_title(); ?>
                  </h3>
                </a>
              </article>
          <?php
              $data_count++;
            endwhile;
            wp_reset_postdata();
          else :
            echo '<p>ニュースはまだ投稿されていません。</p>';
          endif;
          ?>

          <div class="m_pagination">
            <?php
            $args = array(
              'prev_text' => '',
              'next_text' => '',
              'mid_size' => 1,
              'end_size' => 0,
              'total' => $list_query->max_num_pages,
              'show_all' => false,
            );
            the_posts_pagination($args);
            ?>
          </div>
          <!-- /.m_pagination -->
        </div>
        <!-- /.m_news-inner -->
      </div>
      <!-- /.news_contents -->
    </div>

    <?php
    $all_posts_args = array(
      'post_type' => 'news',
      'posts_per_page' => -1, //全ての投稿を取得
      'post_status' => 'publish',
      'orderby' => 'post_date',
      'order' => 'DESC'
    );
    $all_posts_query = new WP_Query($all_posts_args);
    $modal_count = 1;

    if ($all_posts_query->have_posts()) :
      while ($all_posts_query->have_posts()) : $all_posts_query->the_post();
    ?>

        <div class="m_news-modal js_news-modal" id="modal<?php echo $modal_count; ?>" data-modal-target="modal<?php echo $modal_count; ?>">
          <div class="m_news-modal_inner">
            <div class="m_news-modal_header">
              <time class="m_news-modal_date" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('Y.m.d'); ?></time>
              <h2 class="m_news-modal_title"><?php the_title(); ?></h2>
            </div>
            <!-- /.m_news-modal_header -->

            <div class="m_news-modal_txt">
              <p><?php the_content(); ?></p>
            </div>
            <!-- /.m_news-modal_txt -->

            <div class="m_news-modal_pager">
              <div class="m_news-modal-prev">
                <?php if ($modal_count > 1) : ?>
                  <a href="#" class="m_news-modal_prev-btn" data-modal-target="modal<?php echo $modal_count - 1; ?>">
                    <svg width="12" height="20" viewBox="0 0 17 30" fill="none" xmlns="http://www.w3.org/2000/svg" class="m_news-modal_pager-img">
                      <path d="M16.1421 29.2843L1.99995 15.1422L16.1421 1.00003" stroke="#ff9900" stroke-width="2" />
                    </svg>
                    <span class="m_news-modal_prev-btn_desc">前の記事</span>
                  </a>
                <?php endif; ?>
              </div>
              <div class="m_news-modal-next">
                <?php if ($modal_count < $all_posts_query->post_count) : ?>
                  <a href="#" class="m_news-modal_next-btn" data-modal-target="modal<?php echo $modal_count + 1; ?>">
                    <svg width="14" height="25" viewBox="0 0 17 30" fill="none" xmlns="http://www.w3.org/2000/svg" class="m_news-modal_pager-img">
                      <path d="M1.14209 1L15.2842 15.1421L1.14209 29.2843" stroke="#ff9900" stroke-width="2" />
                    </svg>
                    <span class="m_news-modal_prev-btn_desc">次の記事</span>
                  </a>
                <?php endif; ?>
              </div>
            </div>
            <!-- /.m_news-modal_pager -->

          </div>
          <!-- /.m_news-modal_inner -->

          <div class="m_news-modal_close_btn-wrapper">
            <button class="m_news-modal_close-btn js_news-modalClose" data-modal-target="modal<?php echo $modal_count; ?>">
              <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="m_news-modal_close-img">
                <path d="M21.6777 20.1212C21.7799 20.2234 21.8609 20.3448 21.9162 20.4783C21.9715 20.6118 22 20.7549 22 20.8994C22 21.044 21.9715 21.1871 21.9162 21.3206C21.8609 21.4541 21.7799 21.5755 21.6777 21.6777C21.5755 21.7799 21.4541 21.8609 21.3206 21.9162C21.1871 21.9715 21.044 22 20.8994 22C20.7549 22 20.6118 21.9715 20.4783 21.9162C20.3448 21.8609 20.2234 21.7799 20.1212 21.6777L11 12.555L1.87876 21.6777C1.67236 21.884 1.39243 22 1.10055 22C0.808666 22 0.528737 21.884 0.322344 21.6777C0.11595 21.4713 5.75373e-09 21.1913 0 20.8994C-5.75373e-09 20.6076 0.11595 20.3276 0.322344 20.1212L9.44496 11L0.322344 1.87876C0.11595 1.67236 0 1.39243 0 1.10055C0 0.808666 0.11595 0.528737 0.322344 0.322344C0.528737 0.11595 0.808666 0 1.10055 0C1.39243 0 1.67236 0.11595 1.87876 0.322344L11 9.44496L20.1212 0.322344C20.3276 0.11595 20.6076 -5.75373e-09 20.8994 0C21.1913 5.75373e-09 21.4713 0.11595 21.6777 0.322344C21.884 0.528737 22 0.808666 22 1.10055C22 1.39243 21.884 1.67236 21.6777 1.87876L12.555 11L21.6777 20.1212Z" fill="#22222A" />
              </svg>
            </button>
          </div>
          <!-- /.m_news-modal_close_btn-wrapper -->

        </div>
        <!-- /.m_news-modal -->

    <?php
        $modal_count++;
      endwhile;
      wp_reset_postdata();
    endif;
    ?>
  </section>

  <section class="m_section-top l_section" id="contact">
    <div class="l_container-sm">
      <div class="top_section-header">
        <h2 class="m_section-title">Contact</h2>
        <div class="top_btn-wrapper">
          <a href="<?php echo esc_url(home_url('/contact')); ?>" class="m_btn">Contact Form
            <svg width="15" height="8" viewBox="0 0 15 8" fill="none" xmlns="http://www.w3.org/2000/svg" class="m_btn-img">
              <path d="M14.3536 4.35355C14.5488 4.15829 14.5488 3.84171 14.3536 3.64645L11.1716 0.464466C10.9763 0.269204 10.6597 0.269204 10.4645 0.464466C10.2692 0.659728 10.2692 0.976311 10.4645 1.17157L13.2929 4L10.4645 6.82843C10.2692 7.02369 10.2692 7.34027 10.4645 7.53553C10.6597 7.7308 10.9763 7.7308 11.1716 7.53553L14.3536 4.35355ZM0 4.5H14V3.5H0V4.5Z" fill="white" />
            </svg>
          </a>
        </div>
        <!-- /.top_btn-wrapper -->
      </div>
      <!-- /.top_section-header -->
      <div class="m_section-contents m_section_bar l_content">
        <div class="m_contact-inner">
          <div class="m_contact-txts">
            <p class="m_contact-txt_main">2024年度新規メンバー募集中!!</p>
            <p class="m_contact-txt_sub">
              やる気のある方、活動意欲のある選手、マネージャー、カメラマンなど募集しております。<br>
              ブランクのある方でも歓迎しております。<br>
              まずは体験からでも、ご興味を持たれた方はお気軽にお問い合わせください。
            </p>
          </div>
        </div>
        <!-- /.top_instagram-inner -->
      </div>
      <!-- /.top_instagram-contents -->
    </div>
  </section>
</main>

<?php get_footer(); ?>