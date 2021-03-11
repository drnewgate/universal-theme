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
          <?php the_category(); ?>
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
            <?php the_category(); ?>
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
 <img width="65" height="65" src="<?php echo get_the_post_thumbnail_url(null, 'homepage-thumb'); ?>" alt="">
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
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/comment.svg'; ?>" alt="icon: logo comment" class="comments-icon">
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
              <img src="<?php echo get_the_post_thumbnail_url( ); ?>" alt="" class="article-grid-thumb">
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
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/heart-white.svg'; ?>" alt="icon: logo likes" class="likes-icon">
                            <span class="comments-counter"><?php comments_number('0', '1', '%');?></span>
                          </div>
                          <!-- /.comments -->
                          <div class="likes">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/comment-white.svg'; ?>" alt="icon: logo comment" class="likes-icon">
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
              <img src="<?php echo get_the_post_thumbnail_url( ); ?>" alt="" class="article-grid-thumb">
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
                  <h4 class="article-grid-title"><?php echo mb_strimwidth(get_the_title(), 0, 43, '...'); ?></h4>
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
    <?php get_sidebar(); ?>
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
		<section class="investigation" style="background: linear-gradient(0deg, rgba(64, 48, 61, 0.35), rgba(64, 48, 61, 0.35)), url(<?php echo get_the_post_thumbnail_url()?>) no-repeat center center">
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
          'category_name' => 'hot, mnenia, novosti, podborki'

        ]);
        if( $myposts ){
          foreach( $myposts as $post ){
            setup_postdata( $post );
    ?>
    <li class="digest-item">
      <a href="<?php echo get_the_permalink(); ?>" class="digest-item-permalink">
        <img src="<?php echo get_the_post_thumbnail_url()?>" class="digest-thumb">
      </a>
      <div class="digest-info">
        <button class="bookmark">
          <svg width="14" height="18" class="icon icon-bookmark">
            <img src="<?php echo get_template_directory_uri() . '/assets/images/bookmark.svg'; ?>">
          </svg>
        </button>
        <a href="#" class="category-link"><?php the_category(); ?></a>
        <a href="#" class="digest-item-permalink">
          <h3 class="digest-title"><?php the_title(); ?></h3>
        </a>
        <p class="digest-excerpt"><?php echo mb_strimwidth(get_the_excerpt(), 0, 170, '...'); ?></p>
        <div class="digest-footer">
          <span class="digest-date"><?php the_time( 'j F' )?></span>
          <div class="comments digest-comments">
            <img src="<?php echo get_template_directory_uri() . '/assets/images/comment.svg'; ?>" alt="icon: logo comment" class="comments-icon">
            <span class="comments-counter"><?php comments_number('0', '1', '%');?></span>
          </div>
          <div class="likes digest-likes">
            <img src="<?php echo get_template_directory_uri() . '/assets/images/heart.svg'; ?>" alt="icon: logo likes" class="likes-icon">
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
</div>
<!-- /.digest-wrapper -->
</div>
<!-- /.container -->
<?php get_footer (); ?>