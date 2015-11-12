# CS341project
project for CS341.  And stuff.

DEMO GUIDELINES:
1. create a volunteer account: Jane Doe
2. Jane Doe will sign up the calendar to teach on Monday Nov. 30 and Wednesday Dec 2 from 3 pm to 4 pm
	"intro to programming"
3. Create another volunteer account: John Smith
4. John smith will sign up the calendar on monday Nov. 30th and Wednesday Dec. 2 from 3 pm to 4 pm
	to teach "Marketing and Fundraising" for the robotics competition
5. Student Lexi Miar signs up both "intro to Programming" and "Marketing and Fundraising" courses
6. Student Annie Anderson signs up Monday Nov. 30th at 3pm for "Intro to Programming" and 3pm on
	wednesday Dec 2nd for "Marketing and Fundraising"
7. Jane Doe Cancels her class on Wednesday Dec 2.
8. Show your Database tables: user, calendar, ....

TO DO LIST FOR 11/12/15:
1. GET FORM TO ADD EVENTS TO DATABASE
	//Adam has created code but it doesn't exactly work yet. No idea why. Debugging is hard.
2. ALLOW VOLUNTEERS TO ADD EVENTS
	//Done.
3. ALLOW STUDENTS TO SIGN UP FOR EVENTS 
	a. list events student is not signed up for
	b. selecting event puts it on student calendar, prevents future selection
4. MAKE EVENTS USER HAS SIGNED UP FOR DISTINGUISHIBLE FROM THOSE THEY HAVE NOT
5. ALLOW ADMIN/VOLUNTEER TO REMOVE EVENTS
	a. make event clickable
	b. after clicked, allow option to cancel event (toggle "cancelled" from 0 to 1 in DB)
	c. make cancelled events red in calendar, add logic so student can choose another event
		that conflicts with deleted event

