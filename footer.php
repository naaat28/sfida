
<footer class="l_footer">
      <picture id="footer-picture">
        <source
          srcset="<?php echo esc_url( get_template_directory_uri() ); ?>/src/img/footer_home_pc.webp"
          media="(min-width: 1080px)"
          class="l_footer-img"
        />
        <img
          src="<?php echo esc_url( get_template_directory_uri() ); ?>/src/img/footer_home_sp.webp"
          alt=""
          class="l_footer-img"
          width="750"
          height="736"
        />
      </picture>
      
      <div class="l_footer-copyright">
        <p class="l_footer-copyright_txt">&copy; 2024 SFIDA</p>
      </div>
    </footer>

    <?php wp_footer(); ?>
  </body>
</html>