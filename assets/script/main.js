const button = document.querySelector(".nonUserUpvote");
if (button) {
  button.addEventListener("click", () => {
    location.href = "/login.php";
  });
}
