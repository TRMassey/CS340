#1 Find the film title and language name of all films in which ADAM GRANT acted
#Order the results by title, descending (use ORDER BY title DESC at the end of the query)
SELECT film.title, language.name FROM language
INNER JOIN film ON film.language_id = language.language_id
INNER JOIN film_actor ON film_actor.film_id = film.film_id
INNER JOIN actor ON actor.actor_id = film_actor.actor_id
WHERE actor.first_name = "ADAM" AND actor.last_name= "Grant"
ORDER BY film.title DESC;

#2 We want to find out how many of each category of film each actor has started in so return a table with actor's id, actor's first name, actor's last name, category name and the count
#of the number of films that the actor was in which were in that category (You do not need to return the rows whose column count is 0. Please note that there may be some actors with the exact same first names and last names).
SELECT actor.actor_id, actor.first_name, actor.last_name, category.name, count(category.category_id) FROM category
INNER JOIN film_category ON film_category.category_id = category.category_id
INNER JOIN film ON film.film_id = film_category.film_id
INNER JOIN film_actor ON film_actor.film_id = film.film_id
LEFT JOIN actor ON actor.actor_id = film_actor.actor_id
GROUP BY actor.actor_id, category.name;

#3 Find the first name, last name and total combined film length of Sci-Fi films for every actor
#That is the result should list the names of all of the actors (even if an actor has not been in any Sci-Fi films) and the total length of Sci-Fi films they have been in.
SELECT actor.first_name, actor.last_name, SUM(film.length) from category
LEFT JOIN film_category ON film_category.category_id = category.category_id  AND category.name = 'Sci-Fi'
INNER JOIN film ON film.film_id = film_category.film_id
INNER JOIN film_actor ON film_actor.film_id = film.film_id
RIGHT JOIN actor ON actor.actor_id = film_actor.actor_id
GROUP BY actor.actor_id;

#4 Find the first name and last name of all actors who have never been in a Sci-Fi film
# Citation/reference: based on instructor's quiz answers
SELECT actor.first_name, actor.last_name FROM actor
INNER JOIN film_actor ON film_actor.actor_id = actor.actor_id
INNER JOIN film ON film.film_id = film_actor.film_id
INNER JOIN film_category ON film_category.film_id = film.film_id
INNER JOIN category ON film_category.category_id = category.category_id
WHERE actor.actor_id NOT IN (SELECT actor.actor_id FROM actor
INNER JOIN film_actor ON film_actor.actor_id = actor.actor_id
INNER JOIN film ON film.film_id = film_actor.film_id
INNER JOIN film_category ON film_category.film_id = film.film_id
INNER JOIN category ON film_category.category_id = category.category_id
WHERE category.name = 'Sci-Fi')
GROUP BY actor.actor_id;

#5 Find the film title of all films which feature both SCARLETT DAMON and BEN HARRIS
#Order the results by title, descending (use ORDER BY title DESC at the end of the query)
#Warning, this is a tricky one and while the syntax is all things you know, you have to think oustide
#the box a bit to figure out how to get a table that shows pairs of actors in movies
# Citation: Referenced StackOverflow http://stackoverflow.com/questions/28553618/mysql-how-to-reference-attribute-that
#-is-the-conjunction-set-of-two-subqueries?s=1|0.3661, dclayton12
SELECT film.title FROM film
INNER JOIN (SELECT film.title FROM film
INNER JOIN film_actor ON film_actor.film_id = film.film_id
INNER JOIN actor ON actor.actor_id = film_actor.actor_id
WHERE actor.first_name = 'SCARLETT' AND actor.last_name = 'DAMON') sub ON film.title = sub.title
INNER JOIN (SELECT film.title FROM film
INNER JOIN film_actor ON film_actor.film_id = film.film_id
INNER JOIN actor ON actor.actor_id = film_actor.actor_id
WHERE actor.first_name = 'BEN' AND actor.last_name = 'HARRIS') sub2 ON film.title = sub2.title
ORDER BY film.title DESC;