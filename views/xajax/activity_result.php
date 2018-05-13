<select type="text" name="event_id" id="event_id" class="text" value=""/>
<? if (isset($events)) : foreach ($events as $event) : ?>
	<option
		value="<?= $event['event_event_id'] ?>"><?= date('D, M j', strtotime($event['event_date'])) . ' ' . date('g:i', strtotime($event['event_time'])) . ' ' . $event['attending'] . '/' . $event['capacity'] ?></option>
<? endforeach; ?>
<? endif; ?>    
