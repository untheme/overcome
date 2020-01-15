<?php
/**
 * Please see single-event.php in this directory for detailed instructions on how to use and modify these templates.
 *
 * Override this template in your own theme by creating a file at:
 *
 *     [your-theme]/tribe-events/month/mobile.php
 *
 * @version  4.7.1
 */
?>

<script type="text/html" id="tribe_tmpl_month_mobile_day_header">
	<div class="tribe-mobile-day" data-day="[[=date]]">[[ if(has_events) { ]]
		<h3 class="tribe-mobile-day-heading">[[=i18n.for_date]] <span>[[=raw date_name]]<\/span><\/h3>[[ } ]]
	<\/div>
</script>

<script type="text/html" id="tribe_tmpl_month_mobile">
	<div class="tribe-events-mobile tribe-clearfix tribe-events-mobile-event-[[=eventId]][[ if(categoryClasses.length) { ]] [[= categoryClasses]][[ } ]]">
		<div class="ef5-heading mb-20">
			<a class="url" href="[[=permalink]]" title="[[=title]]" rel="bookmark">[[=raw title]]<\/a>
		<\/div>

		<div class="tribe-events-event-body">
			[[ if(imageSrc.length) { ]]
			<div class="tribe-events-event-imagex mb-20">
				<a href="[[=permalink]]" title="[[=title]]">
					<img src="[[=imageSrc]]" alt="[[=title]]" title="[[=title]]">
				<\/a>
			<\/div>
			[[ } ]]
			<div class="tribe-events-event-schedule-detailsx mb-20">
				<span class="tribe-event-date-start text-small">[[=dateDisplay]] <\/span>
			<\/div>
			
			[[ if(excerpt.length) { ]]
			<div class="tribe-event-description mb-20"> [[=raw excerpt]] <\/div>
			[[ } ]]
			<a href="[[=permalink]]" class="tribe-events-read-more ef5-btn accent fill" rel="bookmark">[[=i18n.find_out_more]]<\/a>
		<\/div>
	<\/div>
</script>
