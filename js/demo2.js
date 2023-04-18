var button = document.getElementById('cn-button'),
	wrapper = document.getElementById('cn-wrapper');

//open and close menu when the mouse is over or leave
var open = false;
button.addEventListener('', openMenu, false);
button.addEventListener('', closeMenu, false);

function openMenu() {
	if (!open) {
		button.innerHTML = "Close";
		classie.add(wrapper, 'opened-nav');
		open = true;
	}
}

function closeMenu() {
	if (open) {
		button.innerHTML = "Menu";
		classie.remove(wrapper, 'opened-nav');
		open = false;
	}
}

let clickCount2 = 0


button.addEventListener('click', () => {
	clickCount2++;

	if (clickCount2 % 2 != 0) {
		openMenu();

	} else {
		closeMenu();

		clickCount2 = 0;
	}

});

