<!-- START Application

DISPLAY "Login Page"
DISPLAY "Please select your role:"
DISPLAY "1. Admin"
DISPLAY "2. Student"
READ roleSelection

IF roleSelection == 1
    DISPLAY "Admin Login"
    DISPLAY "Enter Username:"
    READ adminUsername
    DISPLAY "Enter Password:"
    READ adminPassword

    IF adminUsername == "admin" AND adminPassword == "password123"
        DISPLAY "Welcome, Admin!"
        
        DISPLAY "Admin Dashboard"
        DISPLAY "1. View Leaderboard"
        DISPLAY "2. Create Questions"
        DISPLAY "3. Edit/Delete Questions"
        DISPLAY "4. View Student Scores"
        DISPLAY "5. Log Out"
        
        READ adminChoice
        
        IF adminChoice == 1
            DISPLAY "Loading Leaderboard..."
            LOAD scores FROM database
            SORT scores BY highest score
            DISPLAY "Leaderboard:"
            DISPLAY "----------------------"
            DISPLAY "Rank | Student Name | Score"
            FOR EACH score IN scores
                DISPLAY score.rank + " | " + score.studentName + " | " + score.score
            END FOR

        ELSE IF adminChoice == 2
            DISPLAY "Create Questions Form"
            WHILE TRUE
                DISPLAY "Enter Question Text:"
                READ questionText
                DISPLAY "Enter Answer A:"
                READ answerA
                DISPLAY "Enter Answer B:"
                READ answerB
                DISPLAY "Enter Answer C:"
                READ answerC
                DISPLAY "Enter Correct Answer (A/B/C):"
                READ correctAnswer

                IF correctAnswer == "A" OR correctAnswer == "B" OR correctAnswer == "C"
                    SAVE new question TO database
                    DISPLAY "Question Added Successfully"
                ELSE
                    DISPLAY "Invalid correct answer. Please enter A, B, or C."
                END IF
                
                DISPLAY "Do you want to add another question? (yes/no)"
                READ continueAdding
                IF continueAdding == "no"
                    BREAK
                END IF
            END WHILE

        ELSE IF adminChoice == 3
            DISPLAY "Edit/Delete Questions"
            LOAD questions FROM database
            DISPLAY all questions with IDs

            DISPLAY "Enter the ID of the question to edit or delete:"
            READ questionID

            DISPLAY "1. Edit Question"
            DISPLAY "2. Delete Question"
            READ editDeleteChoice

            IF editDeleteChoice == 1
                DISPLAY "Editing Question with ID: " + questionID
                DISPLAY "Enter New Question Text:"
                READ newQuestionText
                DISPLAY "Enter New Answer A:"
                READ newAnswerA
                DISPLAY "Enter New Answer B:"
                READ newAnswerB
                DISPLAY "Enter New Answer C:"
                READ newAnswerC
                DISPLAY "Enter New Correct Answer (A/B/C):"
                READ newCorrectAnswer

                UPDATE question IN database WHERE ID == questionID
                DISPLAY "Question Updated Successfully"

            ELSE IF editDeleteChoice == 2
                DELETE question FROM database WHERE ID == questionID
                DISPLAY "Question Deleted Successfully"

            ELSE
                DISPLAY "Invalid Choice"
            END IF

        ELSE IF adminChoice == 4
            DISPLAY "View Student Scores"
            LOAD scores FROM database
            DISPLAY "Student Name | Score"
            FOR EACH score IN scores
                DISPLAY score.studentName + " | " + score.score
            END FOR

        ELSE IF adminChoice == 5
            DISPLAY "Logging Out..."
            GOTO Login Page
        ELSE
            DISPLAY "Invalid choice. Please try again."
        END IF
    ELSE
        DISPLAY "Invalid Admin Credentials"
        GOTO Login Page
    END IF

ELSE IF roleSelection == 2
    DISPLAY "Student Login"
    DISPLAY "Enter Your Name:"
    READ studentName

    IF studentName != ""
        DISPLAY "Welcome, " + studentName + "!"
        
        INITIALISE score = 0
        INITIALISE currentQuestion = 0
        
        LOAD questions FROM database OR array
        
        WHILE currentQuestion < totalQuestions
            DISPLAY "Question " + (currentQuestion + 1) + ":"
            DISPLAY questions[currentQuestion].text
            DISPLAY "A. " + questions[currentQuestion].answerA
            DISPLAY "B. " + questions[currentQuestion].answerB
            DISPLAY "C. " + questions[currentQuestion].answerC

            DISPLAY "Enter your answer (A/B/C):"
            READ userAnswer
            
            IF userAnswer == questions[currentQuestion].correctAnswer
                score = score + 1
                DISPLAY "Correct!"
            ELSE
                DISPLAY "Wrong! The correct answer was: " + questions[currentQuestion].correctAnswer
            END IF

            INCREMENT currentQuestion by 1
        END WHILE

        DISPLAY "Quiz Finished!"
        DISPLAY "Your final score is: " + score + "/" + totalQuestions

        SAVE score TO database (studentName, score)
    ELSE
        DISPLAY "Invalid Username. Please try again."
        GOTO Login Page
    END IF

ELSE
    DISPLAY "Invalid Role Selection. Please select 1 for Admin or 2 for Student."
    GOTO Login Page
END IF

END Application -->