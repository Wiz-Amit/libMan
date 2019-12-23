// $("#exampleModal").on("show.bs.modal", event => {
//   var button = $(event.relatedTarget);
//   var modal = $(this);
//   // Use above variables to manipulate the DOM
// });

resetFormOnModalExit("#add-book-modal");
resetFormOnModalExit("#add-user-modal");

function resetFormOnModalExit(selector) {
  $(selector).on("hidden.bs.modal", function() {
    $(this)
      .find("form")
      .trigger("reset");
  });
}

$(".books-container .list-group li [name='edit-book']").click(function() {
  var book = {};
  var target = $(this).parent("li");
  book.id = target.find(".id").html();
  book.name = target
    .find(".name")
    .html()
    .replace(": ", "");
  book.authors = target
    .find(".authors")
    .html()
    .replace("by ", "");
  book.count = target
    .find(".count")
    .html()
    .match(/\d+/)[0];

  $("#add-book-modal")
    .find("[name='book-id']")
    .attr('value', book.id);

  $("#add-book-modal")
    .find("[name='book-name']")
    .val(book.name);

  $("#add-book-modal")
    .find("[name='book-authors']")
    .val(book.authors);

  $("#add-book-modal")
    .find("[name='book-count']")
    .val(book.count);

  console.log(book.count);

  $("#add-book-modal").modal("show");
});

$($("[data-target='#add-user-modal']")).click(function() {
  $(this)
    .find("[name='user-update']")
    .attr("value", "false");
});
$(".user-container .list-group li [name='edit-user']").click(function() {
  $("#add-user-modal")
    .find("[name='user-update']")
    .attr("value", "true")
    .val("true");

  var user = {};
  var target = $(this).parent("li");
  user.id = target
    .find(".id")
    .html()
    .replace("(", "")
    .replace(")", "");
  user.name = target
    .find(".name")
    .html()
    .trim();

  $("#add-user-modal")
    .find("[name='user-email']")
    .val(user.id);

  // $("#add-user-modal")
  // .find("[name='user-email']").attr("disabled", true)

  $("#add-user-modal")
    .find("[name='user-name']")
    .val(user.name);

  $("#add-user-modal").modal("show");
});


//highlight selections made on issue form
$(".user-container .list-group li").click(function() {
  $(".issue [name='user-email']").val(
    $(this)
      .find(".id")
      .html()
      .replace("(", "")
      .replace(")", "")
  );
  checkActiveUser();
});

$(".books-container .list-group li").click(function() {
  // if ($(e.target).find("button").length === 0) return;
  $(".issue [name='book-id']").val(
    $(this)
      .find(".id")
      .html()
  );
  checkActiveBook();
});

$(".issue [name='book-id']").keyup(function() {
  checkActiveBook();
});

$(".issue [name='user-email']").keyup(function() {
  checkActiveUser();
});

function checkActiveBook() {
  $(".books-container [data-id]").each(function() {
    $(this).removeClass("active");
  });
  if ($(".issue [name='book-id']").val())
    $(
      ".books-container [data-id=" + $(".issue [name='book-id']").val() + "]"
    ).addClass("active");
}

function checkActiveUser() {
  $(".user-container [data-id]").each(function() {
    $(this).removeClass("active");
  });
  if ($(".issue [name='user-email']").val())
    $(
      ".user-container [data-id='" +
        $(".issue [name='user-email']").val() +
        "']"
    ).addClass("active");
}

initListFilter('[name="search-books"]', '.books-container .list-group-item');
initListFilter('[name="search-users"]', '.user-container .list-group-item');

function initListFilter(searchSelector, listItemSelector) {
  $(searchSelector).on("keyup", function() {
    var value = $(this).val().toLowerCase();
    console.log(value);
    $(listItemSelector).filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
}


initSearchPanelToggler(".books-container [name='search']", ".books-container [name='search-books']");
initSearchPanelToggler(".user-container [name='search']", ".user-container [name='search-users']");

function initSearchPanelToggler(buttonSelector, searchPanelSelector) {
  $(searchPanelSelector).toggle();
  $(buttonSelector).click(function(){
    $(searchPanelSelector).slideToggle();
  });
}