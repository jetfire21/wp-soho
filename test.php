<script type="text/javascript">

            // var count = 2;
            // $(window).scroll(function(){
            //         if  ($(window).scrollTop() == $(document).height() - $(window).height()){
            //            loadArticle(count);
            //            count++;
            //            console.log( "yes" );
            //         }
            // }); 
 
            // function loadArticle(pageNumber){
            //     $.ajax({
            //             url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
            //             type:'POST',
            //             data: "action=infinite_scroll&page_no="+ pageNumber + '&loop_file=loop',
            //             success: function(html){
            //                 $("#content").append(html);   // This will be the div where our content will be loaded
            //             }
            //         });
            //     console.log("ajax");
            //     return false;
            // }
            //    console.log( $(window).scrollTop() );
            //    console.log( "doc window " + $(document).height() - $(window).height() );



<?php // Auto load content on scroll down - movies ?>

jQuery(function($){

	// $('#true_loadmore').click(function(){
	// 	$(this).text('Загружаю...'); // изменяем текст кнопки, вы также можете добавить прелоадер
	// 	console.log(current_page);

	// 	var data = {
	// 		'action': 'loadmore',
	// 		// 'query': true_posts,
	// 		'page' : current_page
	// 	};

	// 	$.ajax({
	// 		url:ajaxurl, // обработчик
	// 		data:data, // данные
	// 		type:'POST', // тип запроса
	// 		success:function(data){
	// 			console.log("ajax yes!");
	// 			if( data ) { 
	// 				$("#loading-text").html('');
	// 				$('#true_loadmore').text('Загрузить ещё');
	// 				$(".movies-catalog").append(data); // вставляем новые посты
	// 				current_page++; // увеличиваем номер страницы на единицу
	// 				if (current_page == max_pages) $("#true_loadmore").remove(); // если последняя страница, удаляем кнопку
	// 			} else {
	// 				$('#true_loadmore').remove(); // если мы дошли до последней страницы постов, скроем кнопку
	// 			}
	// 		},
	// 		beforeSend: function(){
	// 			$("#loading-text").html('<a class="loading-link" href="#">Loading ...</a>');
	// 		}
	// 	});
	// });