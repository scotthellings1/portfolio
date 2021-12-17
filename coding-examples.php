<!DOCTYPE html>
<html lang="en">
    <?php include __DIR__. '/inc/sections/head.php'; ?>
  <body>
    <div class="nav-container">
        <?php include __DIR__. '/inc/sections/mobile_menu.php'; ?>
    </div>
    <div class="flex">
        <?php include __DIR__. '/inc/sections/menu.php'; ?>
      <main>
        <div id="menu-btn" class="menu">
          <span class="bar"></span>
        </div>
        <div class="container coding-examples">


          <div class="content">
            <h1 class="text-xl my-14 ">Coding Examples</h1>
            <!--  typewriter effect-->
            <div class="coding-card p-8 border-accent mb-10">
              <h2 class="text-lg mb-4">Javascript Typewriter</h2>
              <p>This is the code that I used to add the typewriter effect to header of my portfolio website</p>
              <pre><code class="language-js match-braces line-numbers rainbow-braces">
(function () {

// the element to display the messages in the DOM
  const textDisplay = document.querySelector('#typewriter');
// get the data-msg attribute from textDisplay containing a comma seperated list of messages to display
  const getPhrases = textDisplay.dataset.msg;
// split the string of messages by the , and store in an array
  let phrases = getPhrases.split(',');

  let i = 0 ;// iterator for the outer loop
  let j = 0 ;// iterator for the inner loop
  let currentPhrase = [] ;// array to hold each letter of the current phrase in the loop
  let isDeleting = false ;
  let isEnd = false;

  function typewriter() {
    isEnd = false;

    // loop through the array of phrases
    if (i < phrases.length) {
      // if not deleting current phrase and
      // the current value of j is less that the length of the current phrase add the next letter to the
      // currentPhrase array and increase the count of j by 1
      if (!isDeleting && j <= phrases[i].length) {
        currentPhrase.push(phrases[i][j]);
        j++;
        // take the array of letters and make a single string and set the textDisplays innerHTML value to it
        textDisplay.innerHTML = currentPhrase.join('');
      }
      // if deleting current phrase and
      // the current value of j is less that the length of the current phrase remove the next letter from
      // currentPhrase array and decrease the count of j by 1
      if (isDeleting && j <= phrases[i].length) {
        currentPhrase.pop(phrases[i][j]);
        j--;
        // take the array of letters and make a single string and set the textdisplays innerHTML value to it
        textDisplay.innerHTML = currentPhrase.join('');
      }
      // if j is equal to the length of the current phrase set isEnd to true and and set isDeleting to true
      if (j === phrases[i].length) {
        isEnd = true;
        isDeleting = true;
      }
      // if isDeleting is true and j is equal to 0 set the currentPhrase back to an empty array set
      // isDeleting to false and increment i by 1 to get to the next phrase in the outer loop
      if (isDeleting && j === 0) {
        currentPhrase = [];
        isDeleting = false;
        i++;
        // if i is equal to the the total number of phrases set i to 0 to restart the loop
        if (i === phrases.length) {
          i=0;
        }
      }
    }
    const spedUp = Math.floor(Math.random() * 75); // faster speed for deleting
    const normalSpeed = Math.floor(Math.random() * 250); // typing speed
    const time = isEnd ? 3000 : isDeleting ? spedUp : normalSpeed; // if is end is true set timeout
    // to 2 seconds, if is deleting set time to spedUp else set time to normalSpeed
    setTimeout(typewriter, time);
  }

  typewriter();

})();
            </code></pre>
            </div>
            <!--  SQL database Challenge-->
            <div class="coding-card p-8 border-accent mb-10">
              <h2 class="text-lg mb-4">SQL Database Challenge</h2>
              <p>For the SQL section of the course I was challenged to use my knowledge gained to write an
                advanced SQL query that included a subquery and aggregate functions</p>
              <p class="mt-4">Below is the database structure that my query is written for. The database has all the
                information for football teams, games played, the players, referees and goal data as well as other data
                about the games that took place.
              </p>
              <img class="mt-8 mx-auto" src="img/soccer-database.png" alt="soccer database structure">
              <p class="my-10">Below is the query that I wrote. The query returns the top 5 players that were
                substituted off of the pitch in a game with the least amount of time on the pitch.
              </p>
              <pre>

  <code class="  language-js match-braces line-numbers rainbow-braces">SELECT player_id AS "Player ID",
      (SELECT player_name AS "Name"
      FROM player_mast AS pm
      WHERE io.player_id = pm.player_id),
      time_in_out AS "Time On Pitch (min)",
      (SELECT jersey_no AS "Shirt No."
      FROM player_mast AS pm
      WHERE io.player_id = pm.player_id),
      soccer_country.country_name AS "Country"
  FROM player_in_out AS io
      JOIN soccer_country ON soccer_country.country_id = io.team_id
  WHERE in_out = 'O'
  ORDER BY time_in_out ASC LIMIT 5</code>
              </pre>
              <p>First there is the
                <span class="highlight">SELECT</span> part of the query, this is where I am choosing which columns to
                display
                and the
                <span class="highlight">FROM</span> is what table I am getting that data from.
              </p>
              <p class="mt-4">So I have selected the columns <span class="highlight">player_id</span> and <span
                class="highlight">time_in_out </span> from the <span class="highlight">player_in_out</span> table I have
                also used <span
                  class="highlight">AS</span> to give them a more user-friendly name in the output and to better
                describe the data </p>
              <p class="mt-4">I have also selected another table, for this  I Have used
                subqueries to get this data. I am selecting the <span class="highlight">player_name</span> from the
                <span class="highlight">player_mast</span> table and using a <span class="highlight">WHERE</span>
                condition to match the <span class="highlight">player_id</span> from the <span class="highlight">
                  player_in_out</span>
                table to the
                <span class="highlight">player_id</span> on the <span class="highlight">player_mast</span> table
              </p>
              <p class="mt-4">
                Im also selecting <span class="highlight">jersey_no</span> from the <span class="highlight">
                  player_mast</span> table and using a <span class="highlight">WHERE</span>
                condition to match the <span class="highlight">player_id</span> from the <span class="highlight">
                  player_in_out</span> table to the
                <span class="highlight">player_id</span> on the <span class="highlight">player_mast</span> table
              </p>
              <p class="mt-4">
                Next I am using the <span class="highlight">JOIN</span> to connect multiple tables together via a
                related column. I am joining the <span class="highlight">soccer_country</span> table to the
                <span class="highlight">player_in_out</span> table using the <span class="highlight">country_id
              </span> from the <span class="highlight">soccer_country</span> table and the <span
                class="highlight">team_id
              </span> from the <span class="highlight">player_in_out</span> table
              </p>
              <p class="mt-4">
                next after selecting all the data that I want to display I am using a <span class="highlight">WHERE
              </span> condition to filter the results from the <span class="highlight">player_in_out</span> table to
                just those that have the value <span class="highlight">O</span>. This will get me all the players who
                left the pitch
              </p>
              <p class="mt-4">
                Finally the  <span class="highlight">ORDER BY</span> and the <span
                class="highlight">ASC</span> is ordering the results by the <span class="highlight">time_in_out
              </span> column in ascending order. This will give me a list of players that were taken off the pitch
                after and the time in minutes since the game started that they were taken off. Then I am using the
                <span class="highlight">LIMIT 5</span> to limit the results to only 5 rows
              </p>
              <p class="my-10">Below is the output of my query</p>
              <table>
                <thead>
                  <tr>
                    <td>Player Id</td>
                    <td>Name</td>
                    <td>Time On Pitch (min)</td>
                    <td>Shirt No.</td>
                    <td>Country</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>160529</td>
                    <td>Roman Zozulya</td>
                    <td>1</td>
                    <td>8</td>
                    <td>Ukraine</td>
                  </tr>
                  <tr>
                    <td>160154</td>
                    <td>Dimitri Payet</td>
                    <td>2</td>
                    <td>8</td>
                    <td>France</td>
                  </tr>
                  <tr>
                    <td>160085</td>
                    <td>Ivan PeriSic</td>
                    <td>2</td>
                    <td>4</td>
                    <td>Croatia</td>
                  </tr>
                  <tr>
                    <td>160077</td>
                    <td>Ivan Strinic</td>
                    <td>2</td>
                    <td>3</td>
                    <td>Croatia</td>
                  </tr>
                  <tr>
                    <td>160062</td>
                    <td>Edan Hazard</td>
                    <td>2</td>
                    <td>10</td>
                    <td>Belgium</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>
    </div>
      <?php include __DIR__. '/inc/sections/scripts.php'; ?>
    <script src="js/prism.js"></script>

  </body>
</html>
