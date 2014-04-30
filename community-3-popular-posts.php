<?php
widget_css();


if( $widget_config['title'] ) $title = $widget_config['title'];
else $title = 'Popular Posts';

if( $widget_config['no'] ) $limit = $widget_config['no'];
else $limit = 4;

$posts = g::posts(
	array(
		'domain'		=>	etc::domain(),
		'wr_datetime'	=>	'>=' . g::datetime( time() - ONEDAY * 7),
		'order by'		=>	'wr_hit DESC',
		'limit'			=>	$limit
	)
);
?>
<div class='popular-posts'>
	<div class='title'>
		<table width='100%'>
			<tr valign='top'>
				<td align='left' class='title-left'>
					<img src="<?=$widget_config['url']?>/img/popular-posts.png">
					<span class='label'><?=$title?></span>
				</td>
			</tr>
		</table>
	</div>
	
	<div class='popular-posts-items'>
		<?php
		if ( $posts ) {			
			$i = 0;
			foreach ( $posts as $p ) {
					$url = G5_BBS_URL."/board.php?bo_table=$p[bo_table]&wr_id=$p[wr_id]";
					$popular_subject = conv_subject( $p['wr_subject'], 15, '...');
					$no_of_views = $p['wr_hit'];
					$no_of_comments = $p['wr_comment'];
					
						if ( $i == (count($posts)-1) ) $last_post = 'last-post';
						else $last_post = null;
						$i++;
						echo "
								<div class='row $last_post'>
									<span class='post-num'>$i</span>
									<span><a href='$url'>$popular_subject</a></span>
								</div>
								
						";
			 }
		}
		else {
			echo "
					<div class='row'>
						<span class='post-num'>1</span>
						<span><a href='javascript:void(0)'>회원님께서는 현재</a></span>
					</div>
					<div class='row'>
						<span class='post-num'>2</span>
						<span><a href='javascript:void(0)'>필고 커뮤니티 테마를</a></span>
					</div>
					<div class='row'>
						<span class='post-num'>3</span>
						<span><a href='javascript:void(0)'>사용 중 입니다.</a></span>
					</div>						
				";
		}
		?>
	</div>
</div>
