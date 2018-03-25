<?php
class ScoreboardTest extends PHPUnit_Framework_TestCase
{
    public function testHasTeamBadgeReturnsTrue()
    {
        $presenter = new FootballScoreboard();

        $this->assertTrue($presenter->hasTeamBadge(584));
    }

    public function testHasTeamBadgeReturnsFalse()
    {
        $presenter = new FootballScoreboard();

        $this->assertFalse($presenter->hasTeamBadge(9999999));
    }
}
