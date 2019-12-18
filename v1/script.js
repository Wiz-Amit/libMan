// $("#exampleModal").on("show.bs.modal", event => {
//   var button = $(event.relatedTarget);
//   var modal = $(this);
//   // Use above variables to manipulate the DOM
// });

$(".books-container .list-group li").click(function() {
  var book = {};
  book.id = $(this)
    .find(".id")
    .html();
  book.name = $(this)
    .find(".name")
    .html()
    .replace(": ", "");
  book.authors = $(this)
    .find(".authors")
    .html()
    .replace("by ", "");
  book.count = $(this)
    .find(".count")
    .html()
    .match(/\d+/)[0];

  $("#add-book-modal")
    .find("[name='book-id']")
    .val(book.id);

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

$(".user-container .list-group li").click(function() {
  $("#add-user-modal")
    .find("[name='user-update']")
    .attr("value", "true");

  var user = {};
  user.id = $(this)
    .find(".id")
    .html()
    .replace("(", "")
    .replace(")", "");
  user.name = $(this)
    .find(".name")
    .html();

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
