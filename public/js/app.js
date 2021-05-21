var allBook;
var DOCUMENT_ROOT;

window.onload = getDataAllBook();

function addCategory(category) {
  category.classList.toggle("nav__item--active");
  onChangeCategory();
}

function getDataAllBook() {
  DOCUMENT_ROOT = document.getElementById("DOCUMENT_ROOT").innerText;
  DOCUMENT_ROOT = DOCUMENT_ROOT == undefined ? "" : DOCUMENT_ROOT;
  var ajax = new XMLHttpRequest();
  ajax.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      allBook = JSON.parse(this.responseText);
      onReadyData(allBook);
      return allBook;
    }
  };
  ajax.open("GET", DOCUMENT_ROOT + "/book/getAllJSON", true);
  ajax.send();
}

function onReadyData(books) {
  showBook(books);
}
function showBookByCategory(categories) {
  if (categories.length == 0) {
    showBook(allBook);
    return;
  }
  books = allBook.filter((book) =>
    categories.includes(parseInt(book.MaLoaiHang)),
  );
  showBook(books);
}
function showBook(books) {
  var result;

  var categoryBook = document.getElementById("category-book");
  if (!categoryBook) {
    alert("Không thể hiển thị");
    return;
  }

  result = objectToHTML(books);

  categoryBook.innerHTML = result;
}

function onChangeCategory() {
  navCategory = document.getElementById("navCategory");
  categories = navCategory.getElementsByTagName("li");

  // hàm filter để lọc ra thẻ li nào được active, hàm map trả về mã hàng của thẻ li đó
  selectedCategory = Array.from(categories)
    .filter((category) => category.classList.contains("nav__item--active"))
    .map((selectedCategoryHTML) => selectedCategoryHTML.value);

  showBookByCategory(selectedCategory);
}
function objectToHTML(books) {
  var result;
  if (books.length == 0) {
    result = "Không tìm thấy kết quả";
  } else {
    result = books
      .map(
        (book) =>
          `
      <a href="${DOCUMENT_ROOT}/book/detail/${book.MSHH}">
        <div class="category-book__item">
          <img class="category-book__item__image" src="${book.Hinh1}" alt="Ảnh bìa sách ${book.TenHH}">
          <div class="category-book__item__title">
            ${book.TenHH}
          </div>
          <div class="category-book__item__price">
            ${book.Gia}
          </div>
        </div>
      </a>
      `,
      )
      .join("");
  }
  return result;
}
