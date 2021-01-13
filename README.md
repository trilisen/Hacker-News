# Hacker-News

## Todo

- ~~As a user I should be able to create an account.~~

- ~~As a user I should be able to login.~~

- ~~As a user I should be able to logout.~~

- ~~As a user I should be able to edit my account email, password and biography.~~

- ~~As a user I should be able to upload a profile avatar image.~~

- ~~As a user I should be able to create new posts with title, link and description.~~

- ~~As a user I should be able to edit my posts.~~

- ~~As a user I should be able to delete my posts.~~

- ~~As a user I'm able to view most upvoted posts.~~

- ~~As a user I'm able to view new posts.~~

- ~~As a user I should be able to upvote posts.~~

- ~~As a user I should be able to remove upvote from posts.~~

- ~~As a user I'm able to comment on a post.~~

- ~~As a user I'm able to edit my comments.~~

- ~~As a user I'm able to delete my comments.~~

## How to use

1. Clone the repository

```
$ git clone https://github.com/trilisen/hacker-news
```

2. Change your directory to the repository

```
$ cd hacker-news
```

3. Start a localhost server via php

```
$ php -S localhost:8000
```

4. Open your browser

```
localhost:8000
```

## Testers

- Rikard [https://github.com/rikardseg]
- Jakob [https://github.com/gusjak]

## Code Review

1. Error messages is not displayed, you have to echo out in file or maybe solved by add an echo in autoload.php line:25 instead of $errors.

2. login.php 26-51 action:user/register.php: The required statement in input fields could be complete with backend validation for the required fields. - so users get error even if ‘required’ is removed in devtools. Also add validate email check in register.php.

3. users/login.php: An if statement to check if email is correct but password wrong would be useful for the user - let the user know more specific what’s missing.

4. login.php 5 & 25: Two h1 headings, register could have an h2 since the login is the primary content. And it would me more semantic correct.

5. index.php 5 & 14: Same as above, use h1 once followed by h2, h3.

6. index.php 56: The title within the a tag could be inside a heading tag like h3 if you use h1 for "Hacker News" and h2 for "Most upvoted posts" / "Newest posts".

7. index.php 14-18: You could use if() : and closing with endif; as you do in other parts, for consistency in your code.

8. functions.php: You could add a function for sanitize email, string, url, also for validation. So you don’t have to repeat it every time.

9. profile.php 27-32: When a user submit "change email" with an empty email form the users current email removes from the database. If the user by misstakes removes it and logout, it will not be possible to login again. You could add required statement for this. In the input field but also when you validate the email if its empty get error. And you could store the email in the input value.

10. posts/update.php: When user submit empty form or new password its unsets the $\_SESSION[‘user’] and logout the user. Use unset $\_SESSION["user"]["password"]. Or if you want to log out the user for security reasons, add statement to check if value is empty and then redirect back to profile.php.

11. posts/delete.php: When user delete a post you can also delete all comments and likes on this post. Otherwise you will have data in the database connected to a post wish does not exist. And if the same user submit a new post and it gets the same id as the old one - the old comments will be displayed.

12. User/delete.php Same as above, if the user deletes it's account the data from that user should be removed.

13. Great job!! :D
