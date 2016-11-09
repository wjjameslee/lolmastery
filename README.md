# [LolMastery App](lolmastery.000webhostapp.com)
It's been a while since I have updated things around here, but I'd like to take this opportunity to share something
that I worked on a couple months ago during the [Riot Games API Challenge of April 2016.](http://na.leagueoflegends.com/en/news/community/contests/riot-games-api-challenge-2016) 

**Languages Utilized:**
> PHP, Javascript + jQuery + AJAX, HTML5, CSS 

###Features:
1. Determine a summoner's basic info from JSON encoded Riot Games API
2. Delivers analysis on a summoner's **best** champion, indicative of the champion with the most Mastery Points
3. Produce a sliding puzzle, which depicts *that champion*. For entertainment purposes!

###BUGS/ERRORS:
1. **Webpage Errors**
  - Once a search is completed, the page **does not automatically slide** into transition to the next visible component. (ie. Move to the Stats tab)
  - Introduction of new summoner icons (Profile pictures for game users) are not tracked properly by the API, resulting in **no image**.
  - **Compatability issues** with different internet browsers (ie. Older versions Safari/Opera will not display the webpage properly)
  - Refreshing the page too many times (while the current page is reloading) results in some elements **not properly displayed** to the screen.
2. **Data/API Errors**
  - Refreshing the page too many times (while the current page is reloading) results in *Rate Limiting Error* - **unable to load data**.
  - Data is **less accurate** and often times **incorrect** if a summoner does not play/prefer playing Ranked queue matches.
  - Summoners that have been inactive for at least 6 months cannot have their data accessed properly, resulting in **undefined behaviour**.
  - Updates to the API takes time; data might not be **entirely accurate**.
3. **Implementation Errors**
  - The sliding puzzle has a problem with getting the "right focus of the image" (Not all images have the champion positioned in the centre).
  - Page *does not reload to current* because the javascript stack gets erased
  - With the introduction to the Japanese Server, some API-calling functions **don't work for Japanese endpoints**.

###To Finish:
- [x] Smoothly animated button clicks and transitions (Somewhat)
- [x] Randomize champion images each time a Puzzle is called and "drawn"
- [ ] Make webpage more attractive (page layout + text)
- [ ] Add a "reset state" to the Puzzle (enable user to try the puzzle again and again)
