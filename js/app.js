(function () {

// the element to display the success_messages in the DOM
  const textDisplay = document.querySelector('#typewriter');
  if (textDisplay) {


// get the data-msg attribute from textDisplay containing a comma seperated list of success_messages to display
    const getPhrases = textDisplay.dataset.msg;
// split the string of success_messages by the , and store in an array
    let phrases = getPhrases.split(',');
  
    let i = 0;// iterator for the outer loop
    let j = 0;// iterator for the inner loop
    let currentPhrase = [];// array to hold each letter of the current phrase in the loop
    let isDeleting = false;
    let isEnd = false;
  
    function typewriter() {
      isEnd = false;
    
      // loop through the array of phrases
      if (i < phrases.length) {
        // if not deleting current phrase and
        // the current value of j is less that the length of the current phrase add the next letter to the currentPhrase array and increase the count of j by 1
        if (!isDeleting && j <= phrases[i].length) {
          currentPhrase.push(phrases[i][j]);
          j++;
          // take the array of letters and make a single string and set the textdisplays innerHTML value to it
          textDisplay.innerHTML = currentPhrase.join('');
        }
        // if deleting current phrase and
        // the current value of j is less that the length of the current phrase remove the next letter from currentPhrase array and decrease the count of j by 1
        if (isDeleting && j <= phrases[i].length) {
          currentPhrase.pop(phrases[i][j]);
          j--;
          // take the array of letters and make a single string and set the textdisplays innerHTML value to it
          textDisplay.innerHTML = currentPhrase.join('');
        }
        // if j is equal to the lengthog the current phrase set isEnd to true and and set isDeleting to true
        if (j === phrases[i].length) {
          isEnd = true;
          isDeleting = true;
        }
        // if isDeleting is true and j is equal to 0 set the currentPhrase back to an empty arraym set isDeleting to false and increment i by 1 to get to the next phrase in the outer loop
        if (isDeleting && j === 0) {
          currentPhrase = [];
          isDeleting = false;
          i++;
          // if i is equal to the the total number of phrases set i to 0 to restart the loop
          if (i === phrases.length) {
            i = 0;
          }
        }
      }
      const spedUp = Math.floor(Math.random() * 75); // faster speed for deleting
      const normalSpeed = Math.floor(Math.random() * 250); // typing speed
      const time = isEnd ? 3000 : isDeleting ? spedUp : normalSpeed; // if is end is true set timeout to 2 seconds, if is deleting set time to spedUp else set time to normalSpeed
      setTimeout(typewriter, time);
    }
  
    typewriter();
  }
})();

const menuBtn = document.querySelector('#menu-btn')
const menu = document.querySelector('nav.mobile')

menuBtn.addEventListener('click', () => {
  menu.classList.toggle('active')
})

const contactForm = document.querySelector('#contactForm'),
      firstName = document.querySelector('#first_name'),
      lastName = document.querySelector('#last_name'),
      email = document.querySelector('#email'),
      subject = document.querySelector('#subject'),
      messageInput = document.querySelector('#message'),
      emailRegEX = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
let formIsValid = false
if (contactForm) {
  contactForm.addEventListener('submit', (e) => {
    let messages = []
    let errors = document.querySelector('.error-messages')
    let errorList = document.querySelector('.error-messages-list')
    errorList.innerHTML = ''
       if (firstName.value.length === 0) {
        e.preventDefault();
        messages.push('First Name is required')
        firstName.classList.add('error')
        formIsValid = false
      } else {
         firstName.classList.remove('error')
         formIsValid = true
       }
      if (lastName.value.length === 0) {
        e.preventDefault();
        messages.push('Last Name is required')
        lastName.classList.add('error')
        formIsValid = false
      } else {
        lastName.classList.remove('error')
        formIsValid = true
      }
    
      if (email.value.length === 0 ) {
        e.preventDefault();
        messages.push('Email is required')
       email.classList.add('error')
        formIsValid = false
      } else {
        email.classList.remove('error')
        formIsValid = true
      }
      if (emailRegEX.test(email.value)){
        email.classList.remove('error')
        formIsValid = true
      } else {
        e.preventDefault();
        messages.push('Invalid Email')
        email.classList.add('error')
        formIsValid = false
      }
      if (subject.value.length === 0) {
        e.preventDefault();
        messages.push('Subject is required')
        subject.classList.add('error')
        formIsValid = false
      } else {
        subject.classList.remove('error')
        formIsValid = true
      }
      if (messageInput.value.length === 0) {
        e.preventDefault();
        messages.push('Message is required')
        message.classList.add('error')
        formIsValid = false
      } else {
        messageInput.classList.remove('error')
        formIsValid = true
      }

    messages.forEach(message => {
      
    
      let el = document.createElement('li')
      
      el.innerHTML = message
      errorList.append(el)
      errors.style.display = 'block'
    })
  })
}
const treehousePoints = document.querySelector(".treehouse-points");
const treehouseTotalBadges = document.querySelector(".treehouse-total-badges");
const badgeslist = document.querySelector('.badges')
if (treehousePoints && treehouseTotalBadges) {
  axios.get('https://teamtreehouse.com/scotthellings2.json')
    .then(response => {
      treehousePoints.innerHTML = response.data.points.total
      const badges = response.data.badges
      treehouseTotalBadges.innerHTML = badges.length
      let latest5 = badges.slice(-5)
      
      latest5.forEach((badge) => {
        let hrdate = new Date(badge.earned_date).toDateString()
       
        let li = document.createElement('li')
        li.classList.add('flex', 'flex-col')
        li.innerHTML = `
<span class="mb-5"><img src="${badge.icon_url}" alt="${badge.name}"></span>
<span class="mb-5  text-accent">${badge.name}</span>
<span class="mb-5 flex-grow text-xs">Course: ${badge.courses[0].title}</span>
<span class="self-end">${hrdate}</span>`
        badgeslist.appendChild(li)
      })
    })
}
let cardImg = document.querySelectorAll('.card')
 for (let i = 0; i < cardImg.length; i++) {
 let src = cardImg[i].getAttribute('data-image')
 cardImg[i].style.backgroundImage = "url('" + src + "')"
 }
