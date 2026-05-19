
 <?php
function SortComponent($selectedOption)
{
?>
 <div class="d-flex justify-content-center gap-3 mt-4">
<select id="sortselect">
        <option value="title-asc" <?php echo $selectedOption === 'title-asc' ? 'selected' : ''; ?>>title a-z</option>
        <option value="title-desc" <?php echo $selectedOption === 'title-desc' ? 'selected' : ''; ?>>title z-a</option>
        <option value="price-asc" <?php echo $selectedOption === 'price-asc' ? 'selected' : ''; ?>>sort by price:low-high</option>
        <option value="price-desc" <?php echo $selectedOption === 'price-desc' ? 'selected' : ''; ?>>sort by price:high to low</option>
    </select>
   </div>
    <?php
};
?>