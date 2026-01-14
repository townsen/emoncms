# Notes on Calculating Costs

## Calculating daily costs

If you have a cumulative kWh feed then you can use the delta function to get daily
consumption.

You can use the 'Make Stateful' virtual feed processor function to turn a PHPTimeSeries representing tariff costs into a feed that always reflects the current tariff.

You may then think that you could create a virtual feed that calculates cost from the cumulative kWh multiplied by
the tariff feed. You can and it calculates the total cost correctly (total kWh * cost per kWh) but this isn't meaningful at the tariff changeover point and if you apply a delta to this feed then at the point where the tariff changes you will get bogus results. They will however be correct outside of those points.

However source feed multiplier cannot be used with a virtual feed. Hence cost multiplier
process which does the statefulness directly on the incoming feed.

So 'state, x sfeed' is the same as 'sfeed, cost'

To solve the delta problem at discontinuities we need a new processor that converts a feed
into a delta feed during pipeline processing 'sdelta'. This can then be followed by a cost
multiplier process.

Note that the sdelta processor (like the delta function in graphing) marks the data for a day as happening at 01:00 and the
tariff change was input at 08:00 so the calculation is done at the old tariff. This is correct.

At a finer timescale The actual gas consumption occurred at 10:00 and 11:00 and 18:00 and
so when zooming in the costs are with the new tariff.

## Daily Charges

When grouping by 'Daily', 'Weekly', 'Monthly' or 'Annual' the charges on the first day of
the period are used. So if a tariff change occurs later in the period the calculated
charges will be wrong.

To fix this make_stateful would need to take a request for a bridging period and apportion
it.

The 'time' parameter is the start of the period.
