<?php
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/query-plugins/jquery-qtip/jquery.qtip.js');
?> 

<?php
    $items = $dataProvider->getData();
    $nice = true;
    for ($i=0; $i<sizeof($items)-1; $i++) {
        if ($items[$i]->end_time==0) {
            $nice = false;
            break;
        }
    }
    if (empty($items)):
?>
<div style="height:40px"></div>
<?php elseif ($nice): ?>

<div id="timelineContainer" style="padding-top:10px;">

<?php

	function dropMinutesSeconds($timestamp) {
		return Activity::t2t('Y-m-d H:00',$timestamp);
	}
    
	if (!empty($items)):
		$start = $items[0]->start_time;
	
		if (intval(Activity::t2s('H',$start))>9&&intval($items[0]->previous_day)==0) {
			$start = Activity::t2t('Y-m-d 9:00',$start);
		}
	
		if (end($items)->end_time!=0) {
			$end_time_2 = dropMinutesSeconds(end($items)->end_time);
		} else {
			$end_time_2 = dropMinutesSeconds(Activity::s2t('now'));
             if ($end_time_2 - end($items)->start_time > 24*60*60) {
                //limit the display of the timeline to last activity + 24 hours
                $end_time_2 = end($items)->start_time + 24*60*60;
            }
		}
		if (intval(Activity::t2s('H',$end_time_2))<17&&intval(end($items)->previous_day)==0&&Activity::t2s('d',$start)==Activity::t2s('d',$end_time_2)) {
			$end_time_2 = Activity::t2t('Y-m-d 17:00',$end_time_2);
		}
		$start -= 3600;
		$end_time_2 += 3600;
		
		$lengthOfTimeline = floor(ceil($end_time_2-dropMinutesSeconds($start))/(60*60));
		$widthOfMinute = 800/($lengthOfTimeline*60);
	
		$hour = intval(Activity::t2s('H', $start));
		for ($i=$hour; $i<$lengthOfTimeline+$hour; $i++) {
			$h = $i%24;
			$h = $h%6==0 ? '<span style="text-decoration:underline;">'.$h.':00</span>' : $h.':00';
			echo '<div style="float:left; width:'.(60*$widthOfMinute-1).'px; height:50px; border-left:1px solid #ddd"><span style="position:absolute; margin-top:-16px; margin-left:-7px;">'.$h.'</span><div style="width:0px; height:20px; margin:auto; margin-top:14px; border-left:1px solid #eee; "></div></div>';
		}
		$h = $i%24;
		$h = $h%6==0 ? '<span style="text-decoration:underline;">'.$h.':00</span>' : $h.':00';
		echo '<div style="float:left; width:0px; height:50px; border-left:1px solid #ccc"><span style="position:absolute; margin-top:-16px; margin-left:-7px;">'.$h.'</span></div>';
	
?>
<div style="clear: both"></div>
<div style="position: absolute; margin-top: -48px; opacity: 0.5;">

<?php 

$prev_end_time = dropMinutesSeconds($start);

$totalStart = $items[0]->start_time;
$totalMargin = (($totalStart-$prev_end_time)/60)*$widthOfMinute;
if (end($items)->end_time!=0) {
	$totalEnd = end($items)->end_time;
} else {
	$totalEnd = Activity::s2t('now');
    if ($totalEnd - end($items)->start_time > 24*60*60) {
        //limit the display of the timeline to last activity + 24 hours
        $totalEnd = end($items)->start_time + 24*60*60;
    }
}
$totalDuration = ($totalEnd-$totalStart)/60;
$totalWidth = $totalDuration*$widthOfMinute;

$colors = array();

foreach($items as $item) {
    if ($item->getDuration(true)>24*60) {
        $duration = 24*60;
    } else {
        $duration = $item->getDuration(true);
    }
	$width = $duration*$widthOfMinute;
	$margin = ((($item->start_time)-$prev_end_time)/60)*$widthOfMinute;
	$color = '';
	foreach($item->tags as $tag) {
		$color .= $tag->name;
	}
	$color = empty($color) ? '#'.substr(md5('other'), 0, 6) : '#'.substr(md5($color), 0, 6);
	
	foreach($item->tags as $tag) {
		if (!isset($colors[$tag->name])) {
			$colors[$tag->name] = array();
		}
		$colors[$tag->name][] = $color;
	}
	
	echo '<div class="item" tooltip="'.CHtml::encode($item->title).'" style="float:left; border-right:1px solid white; margin-top:5px; width:'.($width-1).'px; margin-left:'.$margin.'px; height:34px; background:'.$color.';"></div>';
	$prev_end_time = $item->end_time;
	$color = '';
}

$totalDuration = Activity::model()->formatDuration($totalDuration, $totalDuration>100);
echo '<div class="total" style="width:'.$totalWidth.'px; margin-left:'.$totalMargin.'px; margin-top:52px; height:20px; border-top:3px solid orange; text-align:center;"><span style="padding:6px; font-size:12px;">'.$totalDuration.'</span></div>';

endif;//if (!empty($items))
?></div>
</div>
<div style="clear: both"></div>


<div
	id="summaryContainer"><!-- <div class="summaryTitle">Summary</div> -->
<?php
	$data = $dataProvider->getData();
	$stats = array(0 => array('name' => '-other-', 'duration' => 0));
	$totalDuration = 0;
	foreach($data as $activity) {
		$totalDuration += $activity->getDuration(true);
		if (empty($activity->tags)) {
			$stats[0]['duration'] += $activity->getDuration(true);
		} else {
			foreach($activity->tags as $tag) {
				if (empty($stats[$tag->id])) {
					$stats[$tag->id] = array('name' => $tag->name, 'duration' => 0);
				}
				$stats[$tag->id]['duration'] += $activity->getDuration(true);
			}
		}
	}
	//move other to the last position or remove completely if empty
	if ($stats[0]['duration'] !== 0) {
		$stats[sizeof($stats)] = $stats[0];
	}
	unset($stats[0]);
	
	//the actual printing
	echo '<table>';
	foreach($stats as $id => $tag) {
		echo '<tr>';
		if ($tag['name']==='-other-') {
			$tag['name'] = 'other';
			$colors['other'][] = '#'.substr(md5($tag['name']), 0, 6);
		}
		echo '<td>';
		$width = 20/sizeof($colors[$tag['name']]);
		foreach($colors[$tag['name']] as $color) {
			echo '<div style="width:'.$width.'px; height:20px; float:left; opacity:0.5; background:'.$color.';"></div>';
		}
		echo '</td>';
		echo '<td>'.$tag['name'].'</td>';
		echo '<td>'.Activity::model()->formatDuration($tag['duration'], false).'h</td>';
		echo '</tr>';
	}
	echo '</table>';
?>
</div><!-- summaryContainer -->
<script type="text/javascript">
	Chilla.Timeline.init();
</script>

<?php else: ?>
<div style="height:40px; color:#ccc; text-align:center; padding:20px;">A nice timeline can't be drawn for this list of activities.</div>
<?php endif; ?>