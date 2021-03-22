<?php get_header(); ?>
<main class='front-page-header'>
  <div class="container">
    <div class="hero">
      <div class="left">
        <?php
          global $post;

          $myposts = get_posts([ 
            'numberposts' => 1,
            'category_name' => 'javascript, css, html, web-design'
          ]);

          if( $myposts ){
            foreach( $myposts as $post ){
              setup_postdata( $post );
        ?>
          <!-- Вывода постов, функции цикла: the_title() и т.д. -->
      <img src="<?php the_post_thumbnail_url() ?>" alt="<?php the_title(); ?>" class="post-thumb">
        <?php $author_id = get_the_author_meta('ID'); ?>
          <a href="<?php echo get_author_posts_url($author_id); ?>" class="author">
            <img src="<?php echo get_avatar_url($author_id); ?>" class="avatar">
              <div class="author-bio">
                <span class="author-name"><?php the_author(); ?></span>
                <span class="author-rank">Должность</span>
          </div>
        </a>
        <div class="post-text">
          <?php 
          foreach (get_the_category() as $category) {
            printf (
              '<a href="%s" class="category-link %s">%s</a>',
              esc_url( get_category_link( $category ) ),
              esc_html( $category -> slug),
              esc_html( $category -> name), 
            );
          }
          ?>
          <h2 class="post-title"><?php echo mb_strimwidth(get_the_title(), 0, 60, '...'); ?></h2>
            <a href="<?php echo the_permalink(); ?>" class="more">Читать далее</a>
        </div>
        <!-- /.post-text -->
        <?php 
            }
          } else {
            // Постов не найдено
            ?> <p>Постов нет</p> <?php 
          }
          wp_reset_postdata(); // Сбрасываем $post
         ?>
      </div>
      <!-- /.left -->
      <div class="right">
        <h3 class="recommend">Рекомендуем</h3>
        <ul class="posts-list">
          <?php
              global $post;

              $myposts = get_posts([ 
                'numberposts' => 5,
                'offset' => 1,
                'category_name' => 'javascript, css, html, web-design',

              ]);

              if( $myposts ){
                foreach( $myposts as $post ){
                  setup_postdata( $post );
           ?>
          <!-- Вывода постов, функции цикла: the_title() и т.д. -->
          <li class="post">
            <?php 
          foreach (get_the_category() as $category) {
            printf (
              '<a href="%s" class="category-link %s">%s</a>',
              esc_url( get_category_link( $category ) ),
              esc_html( $category -> slug),
              esc_html( $category -> name), 
            );
          }
          ?>
            <a class='post-permalink' href="<?php echo get_the_permalink(); ?>">
              <h4 class="post-title"><?php echo mb_strimwidth(get_the_title(), 0, 60, '...'); ?></h4>
          </a>
          </li>
           <?php 
                }
              } else {
                // Постов не найдено
                ?> <p>Постов нет</p> <?php 
              }
              wp_reset_postdata(); // Сбрасываем $post
            ?>
        </ul>
      </div>
      <!-- /.right -->
    </div>
    <!-- .hero --> 
  </div>
  <!-- .conatainer -->
</main>
<div class="container">
<ul class="article-list">
  <?php
    global $post;

    $myposts = get_posts([ 
      'numberposts' => 4,
      'category_name' => 'articles',

    ]);

    if( $myposts ){
      foreach( $myposts as $post ){
        setup_postdata( $post );
    ?>
  <!-- Вывода постов, функции цикла: the_title() и т.д. -->
  <li class="article-item">
    <a class='article-permalink' href="<?php echo get_the_permalink(); ?>">
      <h4 class="article-title"><?php echo mb_strimwidth(get_the_title(), 0, 50, '...'); ?></h4>
    </a>
 <img width="65" height="65" src="<?php 
 if( has_post_thumbnail() ) {
        echo get_the_post_thumbnail_url(null, 'thumb');
        }
        else {
          echo get_template_directory_uri() . '/assets/images/img-default.png';
        }
 ?>" alt="">
  </li>
   <?php 
      }
        } else {
    // Постов не найдено
        ?>
        <p>Постов нет</p>
        <?php 
        }
      wp_reset_postdata(); // Сбрасываем $post
    ?>
</ul>
<!-- /.article-list -->
 <div class="main-grid">
       <ul class="article-grid">
     <?php		
        global $post;
        // формируем запрос в базу данных
        $query = new WP_Query( [
          // Получаем 7 постов
          'posts_per_page' => 7,
          'category__not_in' => 24
        ] );
          // Проверяем, если ли посты
        if ( $query->have_posts() ) {
          // создаем переменную-счетчик постов
          $cnt = 0;
          // если они есть, то выводим
          while ( $query->have_posts() ) {
            $query->the_post();
            // увеличиваем счетчик постов
            $cnt ++;
            switch ($cnt) {
              // выводим первый пост 
              case '1':
                ?> 
          <li class="article-grid-item article-grid-item-1">
            <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
              <span class="category-name"><?php $category = get_the_category();
                echo $category[0]->name; ?></span> 
                <h4 class="article-grid-title"><?php echo get_the_title(); ?></h4>
                  <p class="article-grid-excerpt">
                    <?php echo mb_strimwidth(get_the_excerpt(), 0, 90, '...'); ?>
                  </p>
                  <div class="article-grid-info">
                    <div class="author">
                      <?php $author_id = get_the_author_meta('ID'); ?>
                        <img src="<?php echo get_avatar_url($author_id); ?>" alt="" class="author-avatar">
                        <span class="author-name"><strong><?php the_author(); ?></strong>: <?php the_author_meta('description'); ?></span>
                      </div>
                      <!-- /.author -->
                        <div class="comments">
                          <svg width="19" height="15" fill="#BCBFC2" class="icon comments-icon">
                            <use xlink:href="<?php echo get_template_directory_uri( )?>/assets/images/sprite.svg#comment"></use>
                          </svg>
                          <span class="comments-counter"><?php comments_number('0', '1', '%');?></span>
                        </div>
                        
                        <!-- /.comments -->
                    </div>
                    <!--/article-grid-info-->
                </a>
              </li>
                <?php
                break;
                //выводим второй пост
               case '2':?>
            <li class="article-grid-item article-grid-item-2">
              <img src="<?php if( has_post_thumbnail() ) {
              echo get_the_post_thumbnail_url();
              }
              else {
                echo get_template_directory_uri() . '/assets/images/img-default.png';
              } ?>" alt="" class="article-grid-thumb">
              <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
                <span class="tag">
                  <?php $posttags = get_the_tags();
                  if ( $posttags ) {
                    echo $posttags[0] ->name . ' ';
                  } ?> 
              </span>
          <span class="category-name"><?php $category = get_the_category();
            echo $category[0]->name; ?></span> 
            <h4 class="article-grid-title"><?php the_title(); ?></h4>
              <div class="article-grid-info">
                <div class="author">
                  <?php $author_id = get_the_author_meta('ID'); ?>
                    <img src="<?php echo get_avatar_url($author_id); ?>" alt="" class="author-avatar">
                    <div class="author-info">
                      <span class="author-name"><strong><?php the_author(); ?></strong></span>
                        <span class="date"><?php the_time( 'j F' )?></span>
                    <div class="comments"> 
                      <svg width="19" height="15" fill="#FFFFFF">
                        <use xlink:href="<?php echo get_template_directory_uri( )?>/assets/images/sprite.svg#heart"></use>
                      </svg>
                      <span class="comments-counter"><?php comments_number('0', '1', '%');?></span>
                    </div>
                    <!-- /.comments -->
                    <div class="likes">
                      <svg width="19" height="15" fill="#FFFFFF" class="icon comments-icon">
                        <use xlink:href="<?php echo get_template_directory_uri( )?>/assets/images/sprite.svg#comment"></use>
                      </svg>
                      <span class="likes-counter"><?php comments_number('0', '1', '%');?></span>
                    </div>
                    <!-- /.likes -->
                    </div>
                    <!-- /.author-info -->
                </div>
                <!--/article-grid-info-->
                </div>
                  </a>
                </li>
                <?php
                break;
                //выводим тертий пост
               case '3':?>
            <li class="article-grid-item article-grid-item-3">
              <img src="<?php 
              if( has_post_thumbnail() ) {
              echo get_the_post_thumbnail_url();
              }
              else {
                echo get_template_directory_uri() . '/assets/images/img-default.png';
              }
              ?>" alt="" class="article-grid-thumb">
              <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
                  <h4 class="article-grid-title"><?php echo the_title(); ?></h4>
                </a>
            </li>
              <?php 
                break;
                //выводим остальные посты
              default:?>
            <li class="article-grid-item article-grid-item-default">
              <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
                  <h4 class="article-grid-title"><?php echo mb_strimwidth(get_the_title(), 0, 30, '...'); ?></h4>
                  <p class="article-grid-excerpt"><?php echo mb_strimwidth(get_the_excerpt(), 0, 80, '...'); ?></p>
                  <span class="article-date"><?php the_time( 'j F Y' )?></span>
                </a>
            </li>
                <?php
                break;
            }
            ?>
            <!-- Вывода постов, функции цикла: the_title() и т.д. -->
            <?php 
          }
        } else {
          // Постов не найдено
        }

        wp_reset_postdata(); // Сбрасываем $post
      ?>
    </ul>
    <?php get_sidebar('home-top'); ?>
 </div>
 <!-- /.main-grid -->
</div>
<!-- /.conatainer -->
<section class="investigation">
  <?php		
    global $post;

    $query = new WP_Query( [
      'posts_per_page' => 1,
      'category_name' => 'investigation',
    ] );

  if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
      $query->the_post();
      ?>
      <section class="investigation" style="background: linear-gradient(0deg, rgba(64, 48, 61, 0.35), rgba(64, 48, 61, 0.35)), url(<?php 
        if( has_post_thumbnail() ) {
        echo get_the_post_thumbnail_url();
        }
        else {
          echo get_template_directory_uri() . '/assets/images/img-default.png';
        }?>) no-repeat center center">
        <div class="container">
        <h2 class="investigation-title"><?php the_title(); ?></h2>
          <a href="<?php echo the_permalink(); ?>" class="more">Читать статью</a>

      </div>
    </section>
		<?php 
	}
} else {
	// Постов не найдено
}

wp_reset_postdata(); // Сбрасываем $post
?>
<!-- /.investigation -->

<div class="container">
<div class="digest-wrapper">
  <ul class="digest">
    <?php
        global $post;

        $myposts = get_posts([ 
          'numberposts' => 6,
          'category_name' => 'hot, mnenia, novosti, podborki, photo-report'

        ]);
        if( $myposts ){
          foreach( $myposts as $post ){
            setup_postdata( $post );
    ?>
    <li class="digest-item">
      <a href="<?php the_permalink(); ?>" class="digest-item-permalink">
        <img src="<?php 
        if( has_post_thumbnail() ) {
        echo get_the_post_thumbnail_url();
        }
        else {
          echo get_template_directory_uri() . '/assets/images/img-default.png';
        }
        ?>" class="digest-thumb">
      </a>
      <div class="digest-info">
        <button class="bookmark">
          <svg width="14" height="18" fill="#BCBFC2">
            <use xlink:href="<?php echo get_template_directory_uri( )?>/assets/images/sprite.svg#bookmark"></use>
          </svg>
        </button>
        <?php 
          foreach (get_the_category() as $category) {
            printf (
              '<a href="%s" class="category-link %s">%s</a>',
              esc_url( get_category_link( $category ) ),
              esc_html( $category -> slug),
              esc_html( $category -> name), 
            );
          }
          ?>
        <a href="<?php the_permalink(); ?>" class="digest-item-permalink">
          <h3 class="digest-title"><?php the_title(); ?></h3>
        </a>
        <p class="digest-excerpt"><?php echo mb_strimwidth(get_the_excerpt(), 0, 170, '...'); ?></p>
        <div class="digest-footer">
          <span class="digest-date"><?php the_time( 'j F' )?></span>
          <div class="comments digest-comments">
            <svg width="19" height="15" fill="#BCBFC2" class="icon comments-icon">
              <use xlink:href="<?php echo get_template_directory_uri( )?>/assets/images/sprite.svg#comment"></use>
            </svg>
            <span class="comments-counter"><?php comments_number('0', '1', '%');?></span>
          </div>
          <div class="likes digest-likes">
            <svg width="19" height="15" fill="#BCBFC2">
              <use xlink:href="<?php echo get_template_directory_uri( )?>/assets/images/sprite.svg#heart"></use>
            </svg>
            <span class="comments-counter"><?php comments_number('0', '1', '%');?></span>
          </div>
        </div>
        <!-- /.digest-footer -->
      </div>
      <!-- /.digest-info -->
    </li>
    <?php 
        }
      } else {
        // Постов не найдено
        ?> <p>Постов нет</p> <?php 
      }
      wp_reset_postdata(); // Сбрасываем $post
    ?>
  </ul>
    <!-- Подключаем нижний сайдбар-->
    <?php get_sidebar('home-bottom'); ?>
</div>
<!-- /.digest-wrapper -->
</div>
<!-- /.container -->
<div class="special">
  <div class="container">
    <div class="special-grid">
      <?php
        global $post;

        $query = new WP_Query ([ 
          'post_per_page' => 1,
          'category_name' => 'photo-report',
        ]);

        if( $query -> have_posts() ) {
          while ( $query -> have_posts()) {
            $query->the_post();
          ?>
          <div class="photo-report">
            <!-- Slider main container -->
            <div class="swiper-container photo-report-slider">
              <!-- Additional required wrapper -->
              <div class="swiper-wrapper">
                <!-- Slides -->
                <?php $images = get_attached_media( 'image' );
                  foreach ($images as $image) {
                    echo '<div class="swiper-slide"><img src="';
                    print_r($image -> guid);
                    echo '"></div>';
                }
                ?>
              </div>
              <div class="swiper-pagination"></div>
            </div>
         <div class="photo-report-content">
           <?php 
          foreach (get_the_category() as $category) {
            printf (
              '<a href="%s" class="category-link">%s</a>',
              esc_url( get_category_link( $category ) ),
              esc_html( $category -> name), 
            );
          }
          ?>
       <?php $author_id = get_the_author_meta('ID'); ?>
        <a href="<?php echo get_author_posts_url($author_id); ?>" class="author">
          <img src="<?php echo get_avatar_url($author_id); ?>" class="author-avatar">
            <div class="author-bio">
              <span class="author-name"><?php the_author(); ?></span>
              <span class="author-rank">Должность</span>
          </div>
        </a>
      <h3 class="photo-report-title"><?php the_title(); ?></h3>
        <a href="<?php echo get_the_permalink(); ?>" class="button photo-report-button">
          <svg width="19" height="15" class="icon photo-report-icon">
            <use xlink:href="<?php echo get_template_directory_uri( )?>/assets/images/sprite.svg#images"></use>
          </svg>
          смотреть фото
          <span class="photo-report-counter"><?php echo count($images); ?></span>
        </a>
         </div>
         <!-- /.photo-report-content -->
        </div>
    <?php 
        }
      } else {
        // Постов не найдено
        ?> <p>Постов нет</p> <?php 
      }
      wp_reset_postdata(); // Сбрасываем $post
    ?>
      <div class="other">
        <div class="career-post">
          <?php
            global $post;

          $myposts = get_posts([ 
            'post_per_page' => 1,
            'category_name' => 'career'
          ]);

          if( $myposts ){
            foreach( $myposts as $post ){
              setup_postdata( $post );
              $category = get_the_category();
              
              //echo '<pre>';
              //var_dump($category);
              //echo '</pre>';
        ?>
        
            <a href="<?php echo get_category_link( $category[0] ); ?>" class="category-link"><?php echo $category[0]->name; ?></a>
            <h3 class="career-post-title"><?php the_title(); ?></h3>
            <p class="career-post-excerpt">
              <?php echo mb_strimwidth(get_the_excerpt(), 0, 80, '...'); ?>
            </p>
            <a href="<?php the_permalink(); ?>" class="more">Читать далее</a>
        <?php 
            }
          } else {
            // Постов не найдено
            ?> <p>Постов нет</p> <?php 
          }
          wp_reset_postdata(); // Сбрасываем $post
         ?>
        </div>
        <!-- /.career-post -->
        <div class="other-posts">
            <?php		
              global $post;

              $query = new WP_Query( [
                'post_per_page' => 2,
                'category_name' => 'novosti',
              ] );

          if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
              $query->the_post();
              ?>
          <a href="<?php the_permalink(); ?>" class="other-post other-post-default">
          <h4 class="other-post-title"><?php echo mb_strimwidth(get_the_title(), 0, 25, '...'); ?></h4>
          <p class="other-post-excerpt"><?php echo mb_strimwidth(get_the_excerpt(), 0, 80, '...'); ?></p>
          <span class="other-post-date"><?php the_time( 'j F' )?></span>
          </a>
		<?php 
          }
        } else {
          // Постов не найдено
        }

        wp_reset_postdata(); // Сбрасываем $post
        ?>
          
        </div>
        <!-- /.other-posts -->
      </div>
      <!-- /.other -->
    </div>
    <!-- /.special-grid -->
  </div>
  <!-- /.container -->
</div>
<!-- /.special -->
<?php get_footer (); ?>