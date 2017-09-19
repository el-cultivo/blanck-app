
export const adminMainMenu = ($,item_selector,item_label_selector,submenu_selector, active_class) => {
	let active_selector = ('.'+ active_class);
	let items = $(item_selector);
	
	// Sidebar Item Display
	items.on('click',item_label_selector,function(e){
		let item_label = $(this);
		let item = item_label.closest(item_selector);
		let sub_menu = item.find(submenu_selector);

		if ( !item_label.hasClass(active_class) ) {
			items.find(submenu_selector).slideUp();
			items.find(active_selector).removeClass(active_class);
			item_label.addClass(active_class);
			sub_menu.slideDown();
		}

	});

    // Sidebar Item Display
    items.find(active_selector).parent().find(submenu_selector).slideDown();

}
