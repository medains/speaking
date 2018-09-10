---
title: The Bugs and the Bees
theme: solarized
revealOptions:
    transition: 'fade'
---

# The Bugs and the Bees
## What are bugs, where do they come from, and is there any way of stopping them

Notes:
Aims: Give you a better understanding of the nature and potential sources of bugs,
to give you a better diagnostic toolbox, a broader appreciation of both automated and manual testing,
a better idea of what measures you can take to limit bugs within your products
and perhaps a few laughs along the way.

The SVG in this presentation will not work if generated as static files.

---
<!-- .slide: data-background="./bugs.jpg" class="notPrint" -->

# BUGS! <!-- .element: class="imageHighlight"-->

<footer class="notPrint" style="position:fixed; bottom:0; color:#eee8d5;"><small>Starship Troopers © Tristar/Touchstone 1997</small></footer>

Notes:
So what is a bug?  Audience?

----

## "An error in a computer program or system"
#### Oxford Dictionary
## "a mistake or problem in a computer program"
#### Cambridge Dictionary

Notes:
Dictionary definitions highlight an "error", "mistake", focusing on "program"
Oxford includes "system" which is good because bugs aren't just in the program, but lets go further

----

## "A generic term that describes a malfunction of _undetermined origin_ in a computer or other electronic device."
#### Dictionary.com

Notes:
So we go to "malfunction", I like that, and expand to non-computer elements.
But "undetermined origin" is particularly problematic - does it stop being a bug when we know it's origin?

One of the problems with these definitions is that we use "bug" to cover several things:
* The detected problem - that's not the bug, that's the visible symptom of the bug.
* The report of the problem - that's a bug report, and doesn't always fully describe the symptom or how it happens.
* The problem itself - that's the bug - to continue the medical analogy, this is the disease.

Running along with the analogy, we need to detect the bug (see the symptom), create a fix (a cure)
and we want to set up systems of vaccination, or prevention of reoccurrence.

---
<!-- .slide: id="quadrant" -->

<object data="quadrant.svg" type="image/svg+xml" id="svgquad"></object>

<div class="fragment" data-animate="svgquad" />
<div class="fragment" data-animate="svgquad" />
<div class="fragment" data-animate="svgquad" />

Notes:
Gotta have a quadrant diagram somewhere, so lets get it out of the way

1. Erroneous behaviour :
Actual "wrong" things - 2 + 2 should not equal 5
An error in the code has resulted in the wrong answer, or the wrong thing had been done.

2. Unexpected behaviour :
Here's where it gets a bit less straightforward.  A bug can also expose itself as
surprising behaviour.

For instance - a ticket buying flow that reserves your seat selection near the start
of the flow, errors during payment, and when you restart you find the seats you
tried to buy are unavailable.

This is not what the customer expects, but is not necessarily "wrong".

3. Unintended behaviour :
Various side-effects fall into this category.

For instance - a new (and popular) feature added to your product exhausts the DB handles,
and other features become slow or unusable.

This is common in neural networks, where it is more commonly known as emergent behaviour.

Good examples are Microsofts "Tay" twitter chatbot, which learnt from interactions, and
became a racist nazi in less than a day.  Or the neural network controlled robot that when
its legs were disabled, learned to flip itself onto its back and walk on its knees.
Maybe the stories of "crapageddon" from vacuum-bots encountering a pet mess...

---

### "Daddy, where do bugs come from?"
![origin of bugs](originbug.jpg)

Notes:
Classifying the disease :
Bugs have a lots of causes, we can list quite a few of them.

Why should we do that? :
Doctors learn about symptoms and the related diseases in order to diagnose illnesses, shouldn't we do so with bugs?

The more you know about...
1. the quicker you can be to diagnose and maybe fix live problems
1. the better you can be at defending against those problems when coding.
1. the better you can be at creating test cases.

Diagnosis, cure, prevention

So in order to "know our enemy"

---

![Bug in code](bugincode.svg) <!-- .element style="border: none; box-shadow:none;" -->

Notes:
This is what people usually consider a "bug"
* Typographic errors
* Logical errors
  * Inverted logic - particularly !a && !b IS NOT !(a && b)
  * pass conditional block that should have returned
    * i.e. missing return block
  * not setting vars in some code paths so it is used before init
* Language problems
  * Numerical precision (0.1+0.2) - never store money in floats
  * Stack overflow (heap+stack)
    * Usually causes crashes, but they can lead to security bugs
  * Buffer overflow
    * Innumerable security bugs caused by unchecked buffer writes
  * Numerical overflow
    * https://ai.googleblog.com/2006/06/extra-extra-read-all-about-it-nearly.html
    * Programming Pearls was written in 1986, with a second edition in 2000.
    * The algorithm was an implementation of a version written in 1962
    * No-one notices the overflow in the binary search algorithm until 2006
    * Arguably this is a bug that took 44 years to be detected!
* Dangerous code practice
  * Execution of code contained in data - most injection attacks, but also issues with scoping/sandboxing can result in oddities
  * Zombie code (never run code) waking up, eating brains .. ;)
    * Debug code left in place
    * Boilerplate/generated code left in place
* Copy pasta - not just from copy & paste, also from 'helpful' IDE suggestions or automated code snippets
* Unhandled exceptions
* Conflicting classnames (vavr Future or java.util.Future?)
* Timeouts presence or absence (and interaction)
* Deliberate bad actors - backdoors or deliberately bad code (the classic contractor who left a NOOP loop in to leave room for 'speeding things up')
* Special case code
  * Code that only executes for certain users, or under very rare circumstances
  * Sometimes attempts to deal with other known issues don't work properly (workarounds for hardware issues)
* Bad merge conflict resolution (manual or automated)
* Bug fix reveals another bug

---

![Bug in dependency](bugindependency.svg) <!-- .element style="border: none; box-shadow:none;" -->

Notes:
DEPENDENCY
* Exceeding limits (throughput, hard stop licences e.g. salesforce)
* Edge case behaviour (dropped packets, DB inconsistency, hidden/visible dependency error modes etc..)
* Incompatibilities between components
  * Poor or Wrong API docs, or just deviation from docs (unique IDs that aren't for example)
  * Change in a dependency (breaking changes should be rare, but you never know!)
  * Bug in a dependency - if it's OSS, you might get a fix in, closed source, good luck!
  * Misunderstanding an interface
* Dependency upgrade changes behaviour (e.g. mysql upgrade changing defaults)
* Required usage of poorly fitting software/framework (sunk cost fallacy)

---

![Bug in data](bugindata.svg) <!-- .element style="border: none; box-shadow:none;" -->

Notes:
DATA
* Data problems
  * Corruption/dirty
  * Integrity constraints broken
  * Lack of entropy - failure to seed RNG, or seed with fixed/predicatable value
  * Poisoned cache - don't assume that there is no caching, if it's cacheable data the likelyhood is that it might get cached (by a CDN or edge network)

---

![Bug in environment](buginenvironment.svg) <!-- .element style="border: none; box-shadow:none;" -->

Notes:
ENVIRONMENT
* Race conditions
* Software configuration
  * Can be incredibly complex (riak)
  * headers added by CDN/proxy in production (eg. CSP headers)
* Hardware fault (Pentium FDIV fault, Meltdown, Spectre)
* Deployment issues
  * "split brain" deployment - accidental (some hosts failed to update) or deliberate (blue/green attempts)
  * breaking changes, db migrations and rollbacks (changes to structure of NoSQL documents particularly prone)
  * code that is deployed is not code that was tested - build issues, failure to pin versions of dependencies
  * session stickiness..
  * old session, new code
* 3rd party tracker code brings in other 3rd parties, may be non-deterministic
* Load profile
  * Spikey load - caused by external effects, or high demand and limited availability
  * Non-homogenous load on platform - bad load balancing, or split demand on storage (redis cache key imbalance, high load on reader/writer)

---

![Bug in interface](bugininterface.svg) <!-- .element style="border: none; box-shadow:none;" -->

Notes:
INTERFACE
* Unusual inputs
  * Sometimes a deliberate attempt to break things (iphone reboot SMS 2015/2016 and 2018)
* Bad client behaviour (fail to close TCP connection, consume all connections)
* XSS!   Many security issues fall into this category.

---

![Bug in design](bugindesign.svg) <!-- .element style="border: none; box-shadow:none;" -->

Notes:
THINKING
* Inconsistent requirements
* Wrong assumptions made by developers
* Error in the design!
  * Protocol flaw (Efail (Email + GPG implementations)  KRACK (WPA2) )
  * Infrastructure flaw (non-obvious single points of failure)
  * Cascade failure
* Use outside of design parameters
  * Includes confused users doing things in the wrong order.
* Certain behaviour is accidentally key to another part of the system - and gets retired

---

### "Ford you're turning into a penguin, stop it!"

Note:
So, how do we combat the menace of bugs.
Start by turning off your infinite improbability drive.

----

![Pyramid Vs Bug](pyramidbug.svg) <!-- .element style="border: none; box-shadow:none;" -->

Notes:
* Logically Driven Development (TDD, BDD, and the rest of the automation test pyramid)
  * in general logical assertions drive development
    * automation of testing is almost as good as test-first
  * Can avoid typos, but beware of copy paste between test and implementation - or using too much of the implementation in the test
  * Can expose logical errors
  * Not proof against problems of design, interface, environment etc..  requirement inconsistencies, bad assumptions, race conditions etc..
  * There can be bugs in the assertion code
    * So... mutation testing
    * fault seeding
  * False confidence driven by high coverage metrics - 100% coverage?

----

![Bug Defence](shieldbug.svg) <!-- .element style="border: none; box-shadow:none;" -->

Notes:
* Combine with defensive coding - expect to have every possible thing go wrong, and you'll cover many of the interface,environment,dependency issues
You may think that if you are accessing a REST service that produces JSON, then it will always be JSON.... in practice you may get an XML/HTML response.

----

![Bug Map](findabug.svg) <!-- .element style="border: none; box-shadow:none;" -->

Notes:
* Exploratory testing
  * Challenge the assumptions (inputs, API, environment)
  * Explore user expectations via modeling (4 hour tester)
  * Fuzzing, common bad strings, other white-hat (or black-hat) hacker techniques
  * Challenge the requirements (your users will)
  * Deliberate attempts to "break" the system
    * More like physical product testing
    * Test elements limits, often to destruction

----

![Bug Squash](tentonnebug.svg) <!-- .element style="border: none; box-shadow:none;" -->

Notes:
* Non-functional testing
  * Test under other conditions
  * Load testing
  * Chaos engineering

----

![Bug Monitor](alarmbug.svg) <!-- .element style="border: none; box-shadow:none;" -->

Notes:
* Production error monitoring (newrelic, appdynamics, sentry, cloudreach)

---

### A world without bugs?

![Bug Placard](rightsforbugs.svg) <!-- .element style="border: none; box-shadow:none;" -->

Note:
So we've looked at what bugs are, where they come from, and what we can do about them.
It's clear that we have to Face facts - there are always bugs.
But that doesn't exculpate our responsibility to get rid of them we need to attack bugs from lots of different angles - automation is NOT ENOUGH.

---

# Fin
