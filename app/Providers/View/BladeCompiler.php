<?php

namespace GW2Heroes\Providers\View;

use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler as BaseBladeCompiler;

class BladeCompiler extends BaseBladeCompiler {
    protected function compileInclude($expression) {
        if (Str::startsWith($expression, '(')) {
            $expression = substr($expression, 1, -1);
        }

        // trim @includes
        return "<?php echo trim(\$__env->make($expression, array_except(get_defined_vars(), array('__data', '__path')))->render()); ?>";
    }
}
