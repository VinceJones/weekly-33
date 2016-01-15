#Challenge 033: Prisoner’s Dilemma

This week’s challenge is based on Prisoner’s dilemma. Here is a brief synopsis of the dilemma:

Two members of a criminal gang are arrested and imprisoned. Each prisoner is in solitary confinement with no means of communicating with the other. The prosecutors lack sufficient evidence to convict the pair on the principal charge. They hope to get both sentenced to a year in prison on a lesser charge. Simultaneously, the prosecutor’s offer each prisoner a bargain. Each prisoner is given the opportunity either to: betray the other by testifying that the other committed the crime, or to cooperate with the other by remaining silent. The offer is:
– If A and B each betray the other, each of them serves 2 years in prison
– If A betrays B but B remains silent, A will be set free and B will serve 3 years in prison (and vice versa)
– If A and B both remain silent, both of them will only serve 1 year in prison (on the lesser charge)
For this challenge, you will write an implementation of a bot that will play the prisoner’s dilemma game. All participants will be pitted against each others’ bots in multiple rounds of matches.

You can write your bot in any language, but it must be a command line interface and must adhere to the following specs below.

Command Signature

Your script will be invoked by a headless gamemaster during a match and must return the decision (to confess or remain silent). Your script should accept the following arguments in the following order:

<partnerName> <partnerDiscipline> [partnerPreviousResponse] [playerPreviousResponse]

Argument 1 <partnerName>: This is the name of the opponent or the player who was your partner in crime.
Argument 2 <partnerDiscipline>: This is the discipline of your opponent. It will be one of the following: [client-side, jvm, mobile, .net, php, ruby]
Argument 3 (optional) [partnerPreviousResponse]: This is the response of your opponent from your previous match with that opponent. Is one of “confess” or “silent”. This will not be provided in your first match with this opponent.
Argument 4 (optional) [playerPreviousResponse]: This is your response from the previous match with this opponent. Is one of “confess” or “silent”. This will not be provided in your first match with this opponent.
Return value: (confess|silent). Your script must return the string ‘confess’ or ‘silent’ indicating your response to the interrogation concerning your partner. Confess means you want to betray your partner, whereas “silent” means you choose to remain silent.
The Contest

All submissions will be used in a tournament of matches playing each bot against all others multiple times in a script harness (the “arena”). Each bot will be paired up with every other bot in 100 matches.

An example of a round of matches is presented below. Assume players “foo” (.net discipline) and “bar” (php discipline) playing in this match, and each players’ bot scripts are called foobar and barbot, respectively.

# First match foo vs. bar
/path/to/foobot/bin/foobot bar php
silent
barbot/bin/barbot foo .net
confess

# Second match foo vs. bar
/path/to/foobot/bin/foobot bar php confess silent
confess
barbot/bin/barbot foo .net silent confess
confess

# And so forth ...
At the end of each match your score will be tallied by the number of years in prison based on the results of yours and your paired prisoner’s responses to the match.

Winning

The winner at the end of all the matches is the player with the lowest number of total years to be served in prison.

In the case of an exact tie between two or more players, the winner will be selected via code review of the tying submissions.

Deadline

Because of the holidays, this challenge will be longer than usual. You have three weeks to submit your solution. All submissions must be received by January 4th, 2016.

Additional Rules

Only one bot per person is allowed. If you submit multiple versions then only your latest one or best one (indicated by you) will be entered into the tournament.
You should submit your solution in a zip file or a repo that supports subdirectories. Your binary executable should be in a subdirectory “bin/” in the project root. If your script requires a special invocation (e.g. java -jar …) please provide a README with instructions.
Your bot is allowed write to the disk to store data. Your script should write to a unique path in the current directory. Note that during tournament execution, no provisions will be made to handle any file collisions.
While the responses to a match are indicated as “confess” or “silent,” technically any response other than the word “confess” will be interpreted as “silent”.

### To Install
- run `composer install`

### To run 
- run `php index.php <partnerName> <partnerDiscipline> <partnerLastResponse> <myLastResponse>`