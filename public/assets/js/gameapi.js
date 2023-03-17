// let games = [];
// let currentIndex = 0;
// const pageSize = 6;

// function loadGames() {
//   const options = {
//     method: 'GET',
//     headers: {
//       'X-RapidAPI-Key': 'bf64b77216msh9a58d203c4c0e2ep1cb85ejsn70d6c40dd0e6',
//       'X-RapidAPI-Host': 'free-to-play-games-database.p.rapidapi.com'
//     },
//     mode: 'cors'
//   };

//   fetch('https://free-to-play-games-database.p.rapidapi.com/api/games', options)
//     .then(response => response.json())
//     .then(response => {
//       games = response;
//     })
//     .catch(err => console.error(err));
// }
const endpoint = "https://www.freetogame.com/api/games";
const gamesContainer = document.getElementById("games-container");
const gameIds = [229, 253, 254]; // IDs of the games to display

fetch(endpoint)
  .then(response => response.json())
  .then(data => {
    const games = data.filter(game => gameIds.includes(game.id));
    games.forEach(game => {
      const gameDiv = document.createElement('div');
      gameDiv.className = 'col-lg-3 col-sm-6';
      gameDiv.innerHTML = `
        <div class="item">
          <img src="${game.thumbnail}" alt="${game.title} thumbnail">
          <h4>${game.title}<br><span>${game.genre}</span></h4>
          <ul>
            <li><i class="fa fa-star"></i> ${game.rating}</li>
            <li><i class="fa fa-download"></i> ${game.game_url.split("/").pop()} Downloads</li>
          </ul>
        </div>
      `;
      gamesContainer.appendChild(gameDiv);
    });
  })
  .catch(error => console.error(error));s

// const endpoint = "https://www.freetogame.com/api/games";
// const gamesContainer = document.getElementById("games-container");
// const gameIds = [229, 253, 254]; // IDs of the games to display

// fetch(endpoint)
//   .then(response => response.json())
//   .then(data => {
//     const games = data.filter(game => gameIds.includes(game.id));
//     games.forEach(game => {
//       const gameDiv = document.createElement('div');
//       gameDiv.className = 'col-lg-3 col-sm-6';
//       gameDiv.innerHTML = `
//         <div class="item">
//           <img src="${game.thumbnail}" alt="${game.title} thumbnail">
//           <h4>${game.title}<br><span>${game.genre}</span></h4>
//           <ul>
//             <li><i class="fa fa-star"></i> ${game.rating}</li>
//             <li><i class="fa fa-download"></i> ${game.game_url.split("/").pop()} Downloads</li>
//           </ul>
//         </div>
//       `;
//       gamesContainer.appendChild(gameDiv);
//     });
//   })
//   .catch(error => console.error(error));