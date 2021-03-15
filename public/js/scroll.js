//scroll reset
history.scrollRestoration = "manual";

$(window).on('beforeunload', function(){
      $(window).scrollTop(0);
});
// Selecting The Container.
const container = document.querySelector('.container');
// The Scroll Event.
window.addEventListener('scroll',()=>{
	const {scrollHeight,scrollTop,clientHeight} = document.documentElement;
	if(scrollTop + clientHeight > scrollHeight - 100){
		setTimeout(createFeed,500);
	}
});
// The createPost function creates The HTML for the blog post.
// It append it to the container.
function createFeed(){
    console.log("Reached here");
    var count = localStorage.getItem("count")==null?1:localStorage.getItem("count");
    count=Number(count)+1;
    localStorage.setItem("count", count);
    const Http =  new XMLHttpRequest();
    var host = window.location.protocol + "//" + window.location.host;
    const url = `${host}/feed/${count}`;
    Http.open("GET", url);
    Http.send();

    Http.onreadystatechange=function(){
        console.log("Reached state");
        console.log(Http.responseText);
        const el = document.getElementsByClassName("justify-content-center");
        while (el.length > 0) el[0].remove();
        const feed = document.createElement('div');
        feed.className = 'card';
        feed.innerHTML = Http.responseText;
    //   Appending the post to the container.
        container.appendChild(feed);
    }
	
}