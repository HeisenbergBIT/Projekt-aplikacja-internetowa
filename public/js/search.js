const search = document.querySelector('input[placeholder="search restaurant"]');
const restaurantContainer = document.querySelector(".restaurants");

search.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();

        const data = {search: this.value};

        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (restaurants) {
            restaurantContainer.innerHTML = "";
            loadRestaurants(restaurants)
        });
    }
});

function loadRestaurants(restaurants) {
    restaurants.forEach(restaurant => {
        console.log(restaurant);
        createRestaurant(restaurant);
    });
}

function createRestaurant(restaurant) {
    const template = document.querySelector("#restaurant-template");

    const clone = template.content.cloneNode(true);
    const div = clone.querySelector("div");
    div.id = restaurant.id;
    const image = clone.querySelector("img");
    image.src = `/public/uploads/${restaurant.image}`;
    const title = clone.querySelector("h2");
    title.innerHTML = restaurant.title;
    const description = clone.querySelector("p");
    description.innerHTML = restaurant.description;
    const like = clone.querySelector(".fa-heart");
    like.innerText = restaurant.like;
    const dislike = clone.querySelector(".fa-minus-square");
    dislike.innerText = restaurant.dislike;

    restaurantContainer.appendChild(clone);
}