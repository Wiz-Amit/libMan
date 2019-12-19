// $("#exampleModal").on("show.bs.modal", event => {
//   var button = $(event.relatedTarget);
//   var modal = $(this);
//   // Use above variables to manipulate the DOM
// });

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

$(".user-container .list-group li [name='edit-user']").click(function() {
  $("#add-user-modal")
    .find("[name='user-update']")
    .attr("value", "true");

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

$(".user-container .list-group li").click(function() {
  $(".issue [name='user-email']").val(
    $(this)
      .find(".id")
      .html()
      .replace("(", "")
      .replace(")", "")
  );
});

$(".books-container .list-group li").click(function() {
  $(".issue [name='book-id']").val(
    $(this)
      .find(".id")
      .html()
  );
});
