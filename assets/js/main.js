// Функция обработки процесса приемки товара при его разгрузке с транспорта
// событие отметки checkbox вызывает данную функцию
// событие помещено в переменную checkBox
// генерируем ajax-запрос в генератор адресов размещения stockPositionGen.php (метод POST)
// генератор возвращает нам свободное место на скдладе для товара категории габаритности (A B C)
// присваиваем ajax.response соответствующему элементу в таблице

function addProductToStock(checkBox){
var siteURL = "http://smart-stock.local/";

	//по нажатию на чекбокс он становится не активным
	//чтобы исключить повторные генерирования адреса в складе 
	checkBox.disabled = true;

	// создаем объект ajax-запрса
	var ajax = new XMLHttpRequest();

	// подготовка POST-запроса
	ajax.open("POST", siteURL + "modules/stockPositionGen.php", false);

	// описание заголовка POST-запроса
	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	
	// переменная с содержанием id продукта для передачи в генератор позиций
	var productId = checkBox.parentElement.parentElement.children[2].innerText;
	var orderId = checkBox.parentElement.parentElement.children[1].innerText;

	// посылаем запрос
	ajax.send("id=" +  productId + "&orderId=" +  orderId);

	// переменная с содержанием позиции товара на складе
	positionOnStock = checkBox.parentElement.parentElement.children[4];
	
	// присваиваем значение позиции товара на складе
	positionOnStock.innerText = ajax.response;
}

// Функция обработки процесса отгрузки товара со склада
// событие отметки checkbox вызывает данную функцию
// событие помещено в переменную checkBoxEvent
// генерируем ajax-запрос в модуль поиска размещения товара stockPositionFind.php (метод POST)
// поисковик отмечает товар в БД как отгружаемый 
// === обработка чекбоксов во время отправки товара ==============================
function delProductFromStock(checkBoxEvent){
	
	var siteURL = "http://smart-stock.local/";

	//по нажатию на чекбокс он становится не активным
	//чтобы исключить повторные действие
	checkBoxEvent.disabled = true;

	// создаем объект ajax-запрса
	var ajax = new XMLHttpRequest();

	// подготовка POST-запроса
	ajax.open("POST", siteURL + "modules/sendingProductsFromStock.php", false);

	// описание заголовка POST-запроса
	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	
	// переменная с содержанием адрес товара для передачи в запросе
	var productAddressOnStock = checkBoxEvent.parentElement.parentElement.children[4].innerText;

	//уберем разделительные символы 
	var splitedAddress = productAddressOnStock.split("-");
	 
	// посылаем запрос
	ajax.send("sendProduct=1" + "&size=" +  splitedAddress[0] + 
								"&rack=" +  splitedAddress[1] + 
								"&shelf=" +  splitedAddress[2] + 
								"&tray=" +  splitedAddress[3]);
}