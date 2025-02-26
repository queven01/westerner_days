<?php 
    $job_title_section = get_sub_field('title');
    $jobs = get_sub_field('jobs');
?>

<!-- Button Row -->
<section class="job-row">
    <div class="container">
        <h2><?php echo $job_title_section;?></h2>
        <?php $i = 0; foreach($jobs as $job): 
            $job_title = $job['job_title'];
            $location = $job['location'];
            $department = $job['department'];
            $link = $job['link']; ?>
            <div class="job-container">
                <div class="job-content">
                    <h3 class="title mb-4"><?php echo $job_title;?></h3>
                    <?php if($location): ?><p><b>Location:</b> <?php echo $location;?></p><?php endif; ?>
                    <?php if($department): ?><p><b>Department:</b> <?php echo $department;?></p><?php endif; ?>
                    <a class="btn blue mt-4" target="<?php echo $link['target']; ?>" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
                </div>
            </div>
        <?php $i++; endforeach; ?>
    </div>
</section>