UPDATE current_period
SET current_period.Start_Qty = previous_period.End_Qty
FROM Stock AS current_period
INNER JOIN Stock AS previous_period
ON current_period.Stock_Code = previous_period.Stock_Code
AND cast(current_period.Period as int) = cast(previous_period.Period as int) + 1
AND current_period.warehouse = previous_period.warehouse
WHERE current_period.Period = '' and current_period.warehouse = '';