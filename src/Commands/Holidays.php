<?php

namespace PublicHolidays\Commands;

use Illuminate\Console\Command;
use PublicHolidays\PublicHolidayGenerator;

class Holidays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'public-holidays';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Australia public holidays';

    /**
     * Execute the console command.
     *
     * @param PublicHolidayGenerator $generator
     * @return void
     */
    public function handle(PublicHolidayGenerator $generator)
    {
        $generator->update();
    }
}
